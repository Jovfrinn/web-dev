@extends('fronsite.layouts.navbar')
@section('title', 'Checkout — TrendStore')
@section('content')

<div class="ts-section">
  <div class="container">
    <div class="ts-page-header">
      <h1 class="ts-page-title">
        <span class="material-symbols-outlined">payment</span>
        Checkout
      </h1>
    </div>

    @if(isset($cartItems) && $cartItems->count() > 0)
    <div class="row g-4">

      {{-- Daftar Produk --}}
      <div class="col-lg-7">
        <div class="ts-checkout-card">
          <div class="ts-checkout-card-header">
            <span class="material-symbols-outlined">storefront</span>
            TrendStore
            <span class="ts-checkout-item-count">{{ $cartItems->count() }} produk</span>
          </div>
          <div class="ts-checkout-items">
            @foreach ($cartItems as $item)
            <div class="ts-checkout-item">
              @foreach ($item->product->images as $image)
                @if ($image->is_thumb == 1)
                  <img src="{{ asset('assets/img/' . $image->imageName) }}" alt="{{ $item->product->name_product }}" class="ts-checkout-item-img">
                @endif
              @endforeach
              <div class="ts-checkout-item-detail">
                <span class="ts-checkout-item-name">{{ $item->product->name_product }}</span>
                <span class="ts-checkout-item-qty">{{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, '.', '.') }}</span>
              </div>
              <div class="ts-checkout-item-price">
                Rp {{ number_format($item->sub_total, 0, '.', '.') }}
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- Ringkasan Pembayaran --}}
      <div class="col-lg-5">
        <div class="ts-cart-summary">
          <h3 class="ts-cart-summary-title">Ringkasan Pembayaran</h3>

          <div class="ts-cart-summary-row">
            <span>Total Harga</span>
            <span>Rp {{ number_format($checkouts->last()->grand_total ?? 0, 0, '.', '.') }}</span>
          </div>
          <div class="ts-cart-summary-row">
            <span>Biaya Pengiriman</span>
            <span class="text-success fw-semibold">Gratis</span>
          </div>

          <div class="ts-cart-summary-divider"></div>

          <div class="ts-cart-summary-row ts-cart-summary-total">
            <strong>Total Pembayaran</strong>
            <strong class="ts-price">Rp {{ number_format($checkouts->last()->grand_total ?? 0, 0, '.', '.') }}</strong>
          </div>

          <button id="pay-button" class="ts-btn ts-btn-primary ts-btn-lg w-100 mt-3">
            <span class="material-symbols-outlined">credit_card</span>
            Bayar Sekarang
          </button>

          <a href="{{ route('delete.checkout', $checkouts->last()->id) }}" class="ts-btn ts-btn-outline-primary w-100 mt-2">
            <span class="material-symbols-outlined">arrow_back</span>
            Kembali ke Keranjang
          </a>

          <div class="ts-checkout-security">
            <span class="material-symbols-outlined">lock</span>
            <span>Pembayaran aman & terenkripsi via Midtrans</span>
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="ts-empty-state">
      <span class="material-symbols-outlined">shopping_cart</span>
      <h3>Tidak Ada Produk</h3>
      <p>Silakan kembali ke keranjang belanja.</p>
      <a href="{{ route('cart.show') }}" class="ts-btn ts-btn-primary">Ke Keranjang</a>
    </div>
    @endif
  </div>
</div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
$(document).ready(function() {
    $('#pay-button').click(function() {
        $(this).prop('disabled', true).html('<span class="material-symbols-outlined">hourglass_empty</span> Memproses...');
        $.ajax({
            url: '/create-snap-token',
            method: 'GET',
            success: function(data) {
                if (data.token) {
                    snap.pay(data.token, {
                        onSuccess: function(result) {
                            window.location.href = '{{ route('delete.checkoutCart') }}';
                        },
                        onPending: function(result) {
                            console.log('Payment pending:', result);
                        },
                        onError: function(result) {
                            console.error('Payment error:', result);
                            $('#pay-button').prop('disabled', false).html('<span class="material-symbols-outlined">credit_card</span> Bayar Sekarang');
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax error:', status, error);
                $('#pay-button').prop('disabled', false).html('<span class="material-symbols-outlined">credit_card</span> Bayar Sekarang');
            }
        });
    });
});
</script>
@endsection
