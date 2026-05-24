@extends('backsite.layouts.sidebar')
@section('title', 'Manajemen Pesanan')
@section('breadcrumb')
  <span>Pesanan</span>
@endsection
@section('content')
<div class="admin-page-header">
  <h1 class="admin-page-title">Manajemen Pesanan</h1>
</div>

<div class="admin-card">
  <div class="admin-card-header">
    <h3 class="admin-card-title">Semua Pesanan</h3>
    <div class="d-flex gap-2">
      <form method="GET" class="d-flex gap-2">
        <select name="status" class="admin-form-control" style="width:160px" onchange="this.form.submit()">
          <option value="">Semua Status</option>
          <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Menunggu</option>
          <option value="processing" {{ request('status')=='processing'?'selected':'' }}>Diproses</option>
          <option value="shipped" {{ request('status')=='shipped'?'selected':'' }}>Dikirim</option>
          <option value="delivered" {{ request('status')=='delivered'?'selected':'' }}>Selesai</option>
          <option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>Dibatalkan</option>
        </select>
        <input type="text" name="search" class="admin-form-control" placeholder="Cari pelanggan..." value="{{ request('search') }}" style="width:200px">
        <button type="submit" class="admin-btn admin-btn-primary">Cari</button>
      </form>
    </div>
  </div>
  <div class="admin-card-body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Pelanggan</th>
          <th>Produk</th>
          <th>Total</th>
          <th>Status</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($orders as $index => $order)
        <tr>
          <td><strong>{{ $orders->firstItem() + $index }}</strong></td>
          <td>
            <div>
              <strong>{{ $order->user->name ?? 'Guest' }}</strong><br>
              <small class="text-muted">{{ $order->user->email ?? '' }}</small>
            </div>
          </td>
          <td>{{ $order->checkoutDetails->count() }} item</td>
          <td><strong>Rp {{ number_format($order->grand_total, 0, '.', '.') }}</strong></td>
          <td>
            @php
              $map = ['pending'=>['Menunggu','pending'],'processing'=>['Diproses','processing'],'shipped'=>['Dikirim','shipped'],'delivered'=>['Selesai','delivered'],'cancelled'=>['Dibatalkan','cancelled']];
              $s = $map[$order->status ?? 'pending'];
            @endphp
            <span class="admin-badge admin-badge-{{ $s[1] }}">{{ $s[0] }}</span>
          </td>
          <td>{{ $order->created_at->format('d M Y') }}</td>
          <td>
            <a href="{{ route('admin.orders.show', $order->id) }}" class="admin-btn admin-btn-ghost admin-btn-sm" title="Detail">
              <span class="material-symbols-outlined">visibility</span>
            </a>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada pesanan</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($orders->hasPages())
  <div class="admin-card-body d-flex justify-content-end">
    {{ $orders->links() }}
  </div>
  @endif
</div>
@endsection
