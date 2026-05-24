@extends('fronsite.layouts.navbar')
@section('title', $categories->name_categories . ' — TrendStore')
@section('content')

<div class="ts-section">
  <div class="container">
    <div class="ts-page-header text-center mb-5">
      <h1 class="ts-page-title">
        <span class="material-symbols-outlined ts-title-icon">category</span>
        Kategori: {{ $categories->name_categories }}
      </h1>
      <p class="text-muted mt-2">Jelajahi produk terbaik dalam kategori {{ $categories->name_categories }}.</p>
    </div>

    @if($products->count() > 0)
    <div class="row g-4">
      @foreach ($products as $product)
      <div class="col-6 col-md-4 col-lg-3">
        <a href="{{ route('detail', $product->id) }}" class="ts-product-card">
          <div class="ts-product-img-wrap">
            @php $hasImage = false; @endphp
            @foreach($product->images as $image)
              @if($image->is_thumb == 1)
                <img src="{{ asset('assets/img/'.$image->imageName) }}" alt="{{ $product->name_product }}" class="ts-product-img">
                @php $hasImage = true; @endphp
                @break
              @endif
            @endforeach
            
            @if(!$hasImage)
              <div class="ts-product-img d-flex align-items-center justify-content-center bg-light text-muted">
                <span class="material-symbols-outlined" style="font-size: 3rem;">image</span>
              </div>
            @endif

            @if($product->stock <= 5 && $product->stock > 0)
              <span class="ts-badge ts-badge-warning position-absolute top-0 end-0 m-2">Sisa {{ $product->stock }}</span>
            @elseif($product->stock == 0)
              <span class="ts-badge ts-badge-danger position-absolute top-0 end-0 m-2">Habis</span>
            @endif
          </div>
          
          <div class="ts-product-body">
            <h3 class="ts-product-name">{{ Str::limit($product->name_product, 40) }}</h3>
            <div class="ts-product-price">Rp {{ number_format($product->price, 0, '.', '.') }}</div>
            <div class="ts-product-rating mt-1">
              <div class="ts-stars">
                <span class="material-symbols-outlined" style="font-size: 14px;">star</span>
              </div>
              <span class="ms-1">{{ number_format($product->averageRating(), 1) }}</span>
              <span class="mx-1 text-muted">•</span>
              <span class="text-muted">{{ $product->category->name_categories ?? 'Kategori' }}</span>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @else
    <div class="ts-empty-state text-center py-5">
      <span class="material-symbols-outlined" style="font-size: 4rem; color: #D1D5DB; margin-bottom: 1rem;">inventory_2</span>
      <h3>Produk Kosong</h3>
      <p class="text-muted">Belum ada produk di kategori ini.</p>
      <a href="{{ url('/') }}" class="ts-btn ts-btn-primary mt-3">Kembali ke Beranda</a>
    </div>
    @endif
  </div>
</div>

@endsection
