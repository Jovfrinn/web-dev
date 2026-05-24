@extends('fronsite.layouts.navbar')
@section('title', 'Wishlist Saya — TrendStore')
@section('content')
<div class="ts-section">
  <div class="container">
    <div class="ts-page-header">
      <h1 class="ts-page-title"><span class="material-symbols-outlined">favorite</span> Wishlist Saya</h1>
      <p class="ts-page-subtitle">{{ $wishlists->count() }} produk tersimpan</p>
    </div>
    @if($wishlists->count() > 0)
      <div class="ts-wishlist-grid">
        @foreach($wishlists as $item)
        <div class="ts-product-card">
          @foreach($item->product->images->where('is_thumb', 1)->take(1) as $img)
          <div class="ts-product-img-wrap">
            <img src="{{ asset('assets/img/'.$img->imageName) }}" alt="{{ $item->product->name_product }}" class="ts-product-img">
          </div>
          @endforeach
          <div class="ts-product-info">
            <a href="{{ route('detail', $item->product->id) }}" class="ts-product-name">{{ $item->product->name_product }}</a>
            <div class="ts-product-price">Rp {{ number_format($item->product->price, 0, '.', '.') }}</div>
            <div class="ts-product-meta">
              <span class="ts-product-stock {{ $item->product->stock > 0 ? 'in-stock' : 'out-stock' }}">
                {{ $item->product->stock > 0 ? 'Stok: '.$item->product->stock : 'Habis' }}
              </span>
            </div>
            <div class="d-flex gap-2 mt-2">
              <form action="{{ route('cart.add', $item->product->id) }}" method="POST" class="flex-grow-1">
                @csrf
                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                <button class="ts-btn ts-btn-primary w-100" {{ $item->product->stock == 0 ? 'disabled' : '' }}>
                  <span class="material-symbols-outlined">add_shopping_cart</span>
                  Keranjang
                </button>
              </form>
              <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST">
                @csrf @method('DELETE')
                <button class="ts-btn ts-btn-outline-danger" title="Hapus dari wishlist">
                  <span class="material-symbols-outlined">delete</span>
                </button>
              </form>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    @else
      <div class="ts-empty-state">
        <span class="material-symbols-outlined">favorite_border</span>
        <h3>Wishlist Kosong</h3>
        <p>Simpan produk favoritmu agar mudah ditemukan kembali.</p>
        <a href="{{ url('/') }}" class="ts-btn ts-btn-primary">Jelajahi Produk</a>
      </div>
    @endif
  </div>
</div>
@endsection
