@extends('fronsite.layouts.navbar')
@section('title', 'Pesanan Saya — TrendStore')
@section('content')
<div class="ts-section">
  <div class="container">
    <div class="ts-page-header">
      <h1 class="ts-page-title"><span class="material-symbols-outlined">package_2</span> Pesanan Saya</h1>
    </div>
    @if($orders->count() > 0)
      @foreach($orders as $order)
      <div class="ts-order-card">
        <div class="ts-order-header">
          <div class="ts-order-id">
            <span class="material-symbols-outlined">receipt</span>
            <strong>Pesanan #{{ $order->id }}</strong>
          </div>
          <div class="ts-order-meta">
            <span class="ts-order-date">{{ $order->created_at->format('d M Y, H:i') }}</span>
            @php
              $statusMap = [
                'pending' => ['label' => 'Menunggu Pembayaran', 'class' => 'ts-badge-pending'],
                'processing' => ['label' => 'Sedang Diproses', 'class' => 'ts-badge-processing'],
                'shipped' => ['label' => 'Sedang Dikirim', 'class' => 'ts-badge-shipped'],
                'delivered' => ['label' => 'Pesanan Selesai', 'class' => 'ts-badge-delivered'],
                'cancelled' => ['label' => 'Dibatalkan', 'class' => 'ts-badge-cancelled'],
              ];
              $s = $statusMap[$order->status ?? 'pending'];
            @endphp
            <span class="ts-badge {{ $s['class'] }}">{{ $s['label'] }}</span>
          </div>
        </div>
        <div class="ts-order-body">
          @foreach($order->checkoutDetails->take(3) as $detail)
          <div class="ts-order-item">
            @foreach($detail->product->images->where('is_thumb',1)->take(1) as $img)
              <img src="{{ asset('assets/img/'.$img->imageName) }}" alt="" class="ts-order-item-img">
            @endforeach
            <div class="ts-order-item-info">
              <span class="ts-order-item-name">{{ $detail->product->name_product ?? 'Produk' }}</span>
              <span class="ts-order-item-qty">{{ $detail->quantity }}x @ Rp {{ number_format($detail->product->price ?? 0, 0, '.', '.') }}</span>
            </div>
          </div>
          @endforeach
          @if($order->checkoutDetails->count() > 3)
            <div class="ts-order-more">+{{ $order->checkoutDetails->count() - 3 }} produk lainnya</div>
          @endif
        </div>
        <div class="ts-order-footer">
          <div class="ts-order-total">
            <span>Total Pembayaran:</span>
            <strong>Rp {{ number_format($order->grand_total, 0, '.', '.') }}</strong>
          </div>
          <div class="ts-order-actions">
            <a href="{{ route('orders.show', $order->id) }}" class="ts-btn ts-btn-outline-primary ts-btn-sm">Detail Pesanan</a>
          </div>
        </div>
      </div>
      @endforeach
      <div class="mt-4 d-flex justify-content-center">
        {{ $orders->links() }}
      </div>
    @else
      <div class="ts-empty-state">
        <span class="material-symbols-outlined">package_2</span>
        <h3>Belum Ada Pesanan</h3>
        <p>Kamu belum pernah melakukan pembelian. Mulai belanja sekarang!</p>
        <a href="{{ url('/') }}" class="ts-btn ts-btn-primary">Mulai Belanja</a>
      </div>
    @endif
  </div>
</div>
@endsection
