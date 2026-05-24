@extends('backsite.layouts.sidebar')
@section('title', 'Dashboard')
@section('content')

<div class="admin-page-header">
  <h1 class="admin-page-title">Dashboard</h1>
  <p class="admin-page-subtitle">Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Berikut ringkasan toko hari ini.</p>
</div>

{{-- ==================== STAT CARDS ==================== --}}
<div class="admin-stats-grid">
  <div class="admin-stat-card border-0 shadow-sm">
    <div class="admin-stat-card-icon emerald">
      <span class="material-symbols-outlined">payments</span>
    </div>
    <div class="admin-stat-card-info">
      <div class="admin-stat-card-label">Total Pendapatan</div>
      <span class="admin-stat-card-value">Rp {{ number_format($totalRevenue ?? 0, 0, '.', '.') }}</span>
      <span class="text-muted" style="font-size: 12px; margin-top: 4px; display: block;">Dari pesanan selesai</span>
    </div>
  </div>

  <div class="admin-stat-card border-0 shadow-sm">
    <div class="admin-stat-card-icon amber">
      <span class="material-symbols-outlined">receipt_long</span>
    </div>
    <div class="admin-stat-card-info">
      <div class="admin-stat-card-label">Pesanan Masuk</div>
      <span class="admin-stat-card-value">{{ $newOrders ?? 0 }}</span>
      <span class="text-muted" style="font-size: 12px; margin-top: 4px; display: block;">Menunggu diproses</span>
    </div>
  </div>

  <div class="admin-stat-card border-0 shadow-sm">
    <div class="admin-stat-card-icon blue">
      <span class="material-symbols-outlined">inventory_2</span>
    </div>
    <div class="admin-stat-card-info">
      <div class="admin-stat-card-label">Total Produk</div>
      <span class="admin-stat-card-value">{{ $totalProducts ?? 0 }}</span>
      <span class="text-muted" style="font-size: 12px; margin-top: 4px; display: block;">{{ $outOfStock ?? 0 }} stok habis</span>
    </div>
  </div>

  <div class="admin-stat-card border-0 shadow-sm">
    <div class="admin-stat-card-icon purple">
      <span class="material-symbols-outlined">group</span>
    </div>
    <div class="admin-stat-card-info">
      <div class="admin-stat-card-label">Total Pelanggan</div>
      <span class="admin-stat-card-value">{{ $totalUsers ?? 0 }}</span>
      <span class="text-muted" style="font-size: 12px; margin-top: 4px; display: block;">Pengguna terdaftar</span>
    </div>
  </div>
</div>

{{-- ==================== ORDER STATUS OVERVIEW ==================== --}}
<div class="row g-4 mt-2">
  <div class="col-lg-8">
    <div class="admin-card">
      <div class="admin-card-header">
        <h3 class="admin-card-title">
          <span class="material-symbols-outlined">receipt_long</span>
          Pesanan Terbaru
        </h3>
        <a href="{{ route('admin.orders') }}" class="admin-btn admin-btn-ghost admin-btn-sm">Lihat Semua</a>
      </div>
      <div class="admin-card-body p-0">
        @if(isset($recentOrders) && $recentOrders->count() > 0)
        <table class="admin-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Pelanggan</th>
              <th>Total</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($recentOrders as $index => $order)
            <tr>
              <td><strong>{{ $index + 1 }}</strong></td>
              <td>{{ $order->user->name ?? 'Guest' }}</td>
              <td>Rp {{ number_format($order->grand_total, 0, '.', '.') }}</td>
              <td>
                @php
                  $statusClass = match($order->status ?? 'pending') {
                    'pending' => 'pending',
                    'processing' => 'processing',
                    'shipped' => 'shipped',
                    'delivered' => 'delivered',
                    'cancelled' => 'cancelled',
                    default => 'pending'
                  };
                  $statusLabel = match($order->status ?? 'pending') {
                    'pending' => 'Menunggu',
                    'processing' => 'Diproses',
                    'shipped' => 'Dikirim',
                    'delivered' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                    default => 'Menunggu'
                  };
                @endphp
                <span class="admin-badge admin-badge-{{ $statusClass }}">{{ $statusLabel }}</span>
              </td>
              <td>{{ $order->created_at->format('d M Y') }}</td>
              <td>
                <a href="{{ route('admin.orders.show', $order->id) }}" class="admin-btn admin-btn-ghost admin-btn-sm">
                  <span class="material-symbols-outlined">visibility</span>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <div class="admin-empty-state">
          <span class="material-symbols-outlined">receipt_long</span>
          <p>Belum ada pesanan masuk</p>
        </div>
        @endif
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    {{-- Order Status Summary --}}
    <div class="admin-card mb-4">
      <div class="admin-card-header">
        <h3 class="admin-card-title">
          <span class="material-symbols-outlined">pie_chart</span>
          Status Pesanan
        </h3>
      </div>
      <div class="admin-card-body">
        <div class="admin-status-list">
          <div class="admin-status-item">
            <span class="admin-badge admin-badge-pending">Menunggu</span>
            <strong>{{ $orderStats['pending']->total ?? 0 }}</strong>
          </div>
          <div class="admin-status-item">
            <span class="admin-badge admin-badge-processing">Diproses</span>
            <strong>{{ $orderStats['processing']->total ?? 0 }}</strong>
          </div>
          <div class="admin-status-item">
            <span class="admin-badge admin-badge-shipped">Dikirim</span>
            <strong>{{ $orderStats['shipped']->total ?? 0 }}</strong>
          </div>
          <div class="admin-status-item">
            <span class="admin-badge admin-badge-delivered">Selesai</span>
            <strong>{{ $orderStats['delivered']->total ?? 0 }}</strong>
          </div>
          <div class="admin-status-item">
            <span class="admin-badge admin-badge-cancelled">Dibatalkan</span>
            <strong>{{ $orderStats['cancelled']->total ?? 0 }}</strong>
          </div>
        </div>
      </div>
    </div>

    {{-- Low Stock Alert --}}
    <div class="admin-card border-0 shadow-sm" style="border-radius: 16px;">
      <div class="admin-card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
        <h5 class="fw-bold mb-0 d-flex justify-content-between align-items-center w-100">
          <div>
            <span class="material-symbols-outlined align-middle me-2 text-danger" style="font-size: 22px;">error</span>
            Stok Menipis
          </div>
          <a href="{{ route('get.stock') }}" class="btn btn-sm btn-light fw-medium rounded-pill px-3 shadow-sm border">Kelola</a>
        </h5>
      </div>
      <div class="admin-card-body p-4">
        @if(isset($lowStockProducts) && $lowStockProducts->count() > 0)
          <div class="d-flex flex-column gap-3">
            @foreach($lowStockProducts->take(5) as $product)
            <div class="d-flex align-items-center p-3 rounded-4" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
              @php $hasThumb = false; @endphp
              @foreach($product->images->where('is_thumb', 1)->take(1) as $img)
                <img src="{{ asset('assets/img/'.$img->imageName) }}" alt="{{ $product->name_product }}" class="rounded shadow-sm bg-white" style="width: 52px; height: 52px; object-fit: contain; padding: 4px;">
                @php $hasThumb = true; @endphp
              @endforeach
              @if(!$hasThumb)
                <div class="rounded shadow-sm bg-white d-flex align-items-center justify-content-center text-muted" style="width: 52px; height: 52px; border: 1px solid #e2e8f0;">
                  <span class="material-symbols-outlined">inventory_2</span>
                </div>
              @endif
              
              <div class="ms-3 flex-grow-1 min-w-0">
                <h6 class="mb-1 text-truncate fw-bold text-dark" style="font-size: 14.5px;">{{ $product->name_product }}</h6>
                <div class="d-flex align-items-center gap-2">
                  <span class="badge rounded-pill text-danger" style="background-color: #fee2e2; font-weight: 600; padding: 5px 10px; font-size: 11px;">
                    Sisa {{ $product->stock }}
                  </span>
                  <span class="text-muted" style="font-size: 12px; font-weight: 500;">Perlu ditambah</span>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        @else
          <div class="d-flex flex-column align-items-center justify-content-center py-4">
            <div class="rounded-circle bg-success-subtle d-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
              <span class="material-symbols-outlined text-success" style="font-size: 32px;">check_circle</span>
            </div>
            <h6 class="fw-bold text-dark mb-1">Semua Stok Aman</h6>
            <p class="text-muted fs-7 mb-0">Tidak ada produk dengan stok menipis.</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection
