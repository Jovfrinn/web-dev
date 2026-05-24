@extends('backsite.layouts.sidebar')
@section('title', 'Detail Pesanan #' . $order->id)
@section('breadcrumb')
  <a href="{{ route('admin.orders') }}">Pesanan</a>
  <span class="material-symbols-outlined sep">chevron_right</span>
  <span>Detail Pesanan</span>
@endsection
@section('content')

<div class="admin-page-header d-flex justify-content-between align-items-center">
  <div>
    <h1 class="admin-page-title mb-1">Detail Pesanan #{{ $order->id }}</h1>
    <p class="text-muted m-0">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }}</p>
  </div>
  <div>
    <a href="{{ route('admin.orders') }}" class="admin-btn admin-btn-ghost">
      <span class="material-symbols-outlined align-middle me-1">arrow_back</span> Kembali
    </a>
  </div>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="admin-card mb-4">
      <div class="admin-card-header">
        <h3 class="admin-card-title">
          <span class="material-symbols-outlined me-2">shopping_bag</span>Daftar Produk
        </h3>
      </div>
      <div class="admin-card-body p-0">
        <table class="admin-table">
          <thead class="bg-light">
            <tr>
              <th>Produk</th>
              <th class="text-center">Harga</th>
              <th class="text-center">Qty</th>
              <th class="text-end">Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach($order->checkoutDetails as $detail)
            <tr>
              <td>
                <div class="d-flex align-items-center gap-3">
                  @php $hasImg = false; @endphp
                  @foreach($detail->product->images as $img)
                    @if($img->is_thumb == 1)
                      <img src="{{ asset('assets/img/'.$img->imageName) }}" alt="{{ $detail->product->name_product }}" class="rounded border" style="width:50px; height:50px; object-fit:cover;">
                      @php $hasImg = true; @break @endphp
                    @endif
                  @endforeach
                  @if(!$hasImg)
                    <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted" style="width:50px; height:50px;">
                      <span class="material-symbols-outlined">image</span>
                    </div>
                  @endif
                  <span class="fw-semibold">{{ $detail->product->name_product }}</span>
                </div>
              </td>
              <td class="text-center">Rp {{ number_format($detail->price, 0, '.', '.') }}</td>
              <td class="text-center">{{ $detail->quantity }}</td>
              <td class="text-end fw-bold">Rp {{ number_format($detail->sub_total, 0, '.', '.') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="admin-card-footer border-top bg-light p-4">
        <div class="d-flex justify-content-between align-items-center">
          <span class="text-muted fw-semibold">Total Pembayaran</span>
          <span class="fs-4 fw-bold text-primary">Rp {{ number_format($order->grand_total, 0, '.', '.') }}</span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <!-- Status Update Card -->
    <div class="admin-card mb-4">
      <div class="admin-card-header">
        <h3 class="admin-card-title">
          <span class="material-symbols-outlined me-2">cached</span>Status Pesanan
        </h3>
      </div>
      <div class="admin-card-body">
        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
          @csrf
          <div class="mb-3">
            <label class="form-label text-muted fw-semibold">Ubah Status</label>
            <select name="status" class="admin-form-control form-select-lg">
              <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu Diproses</option>
              <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Sedang Diproses</option>
              <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dalam Pengiriman</option>
              <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Selesai / Terkirim</option>
              <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
          </div>
          <button type="submit" class="admin-btn admin-btn-primary w-100">Simpan Status</button>
        </form>
      </div>
    </div>

    <!-- Customer Info Card -->
    <div class="admin-card">
      <div class="admin-card-header">
        <h3 class="admin-card-title">
          <span class="material-symbols-outlined me-2">person</span>Informasi Pelanggan
        </h3>
      </div>
      <div class="admin-card-body">
        <div class="mb-3">
          <span class="text-muted d-block" style="font-size: 12px;">Nama Lengkap</span>
          <strong class="d-block text-dark">{{ $order->user->name ?? 'Guest User' }}</strong>
        </div>
        <div class="mb-3">
          <span class="text-muted d-block" style="font-size: 12px;">Email</span>
          <strong class="d-block text-dark">{{ $order->user->email ?? '-' }}</strong>
        </div>
        <div class="mb-3">
          <span class="text-muted d-block" style="font-size: 12px;">Nomor Telepon</span>
          <strong class="d-block text-dark">{{ $order->user->phone ?? '-' }}</strong>
        </div>
        <div class="mb-3">
          <span class="text-muted d-block" style="font-size: 12px;">Alamat Pengiriman</span>
          <div class="p-3 bg-light rounded mt-1 border">
            {{ $order->shipping_address ?? ($order->user->address ?? 'Tidak ada alamat') }}
          </div>
        </div>
        @if($order->notes)
        <div>
          <span class="text-muted d-block" style="font-size: 12px;">Catatan Pembeli</span>
          <div class="p-3 bg-warning bg-opacity-10 rounded mt-1 border border-warning text-dark">
            {{ $order->notes }}
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection
