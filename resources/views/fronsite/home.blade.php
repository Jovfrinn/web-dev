@extends('fronsite.layouts.navbar')
@section('title', 'TrendStore — Belanja Online Terpercaya')
@section('content')

{{-- ===================== HERO SECTION ===================== --}}
<section class="ts-hero mt-4">
  <div class="ts-hero-bg"></div>
  <div class="ts-hero-content">
    <div class="ts-hero-badge">
      <span class="material-symbols-outlined" style="font-size: 16px;">local_fire_department</span>
      Produk Terlaris Minggu Ini
    </div>
    <h1 class="ts-hero-title">Belanja Lebih Mudah,<br>Harga Lebih Hemat</h1>
    <p class="ts-hero-subtitle">Ribuan produk pilihan dengan kualitas terjamin. Pengiriman cepat ke seluruh Indonesia.</p>
    
    <div style="display: flex; gap: 12px; margin-top: 24px;">
      <a href="{{ route('get.category', 1) }}" class="ts-btn" style="background: var(--ts-white); color: var(--ts-primary); font-weight: 600;">
        <span class="material-symbols-outlined">explore</span>
        Jelajahi Produk
      </a>
      <a href="{{ route('get.category', 2) }}" class="ts-btn" style="border: 1px solid var(--ts-white); color: var(--ts-white); font-weight: 600;">
        Lihat Promo
      </a>
    </div>
  </div>
  
  <div class="ts-hero-image" style="background: rgba(255,255,255,0.1); border-radius: 50%; width: 300px; height: 300px; right: 10%; bottom: -50px; display: flex; align-items: center; justify-content: center;">
    <span class="material-symbols-outlined" style="font-size: 120px; color: rgba(255,255,255,0.8);">shopping_bag</span>
  </div>
</section>

{{-- ===================== CATEGORY SECTION ===================== --}}
<section class="ts-section">
  <div class="container">
    <div class="ts-section-header">
      <h2 class="ts-section-title">Kategori Produk</h2>
      <p class="ts-section-subtitle">Temukan produk berdasarkan kategori favoritmu</p>
    </div>
    <div class="ts-category-grid">
      @foreach(getCategory() as $category)
      <a href="{{ route('get.category', $category->id) }}"
         class="ts-category-card {{ Request::is('category/'.$category->id) ? 'active' : '' }}">
        <div class="ts-category-icon">
          @if($category->id == 1)
            <span class="material-symbols-outlined">lunch_dining</span>
          @elseif($category->id == 2)
            <span class="material-symbols-outlined">local_drink</span>
          @elseif($category->id == 3)
            <span class="material-symbols-outlined">school</span>
          @elseif($category->id == 4)
            <span class="material-symbols-outlined">checkroom</span>
          @else
            <span class="material-symbols-outlined">category</span>
          @endif
        </div>
        <span class="ts-category-name">{{ $category->name_categories }}</span>
      </a>
      @endforeach
    </div>
  </div>
</section>

{{-- ===================== PRODUK TERLARIS ===================== --}}
<section class="ts-section ts-section-alt">
  <div class="container">
    <div class="ts-section-header">
      <div>
        <h2 class="ts-section-title">
          <span class="material-symbols-outlined ts-title-icon">trending_up</span>
          Produk Terlaris
        </h2>
        <p class="ts-section-subtitle">Produk paling banyak dibeli oleh pelanggan kami</p>
      </div>
      <a href="{{ route('get.category', 1) }}" class="ts-btn ts-btn-outline-primary ts-btn-sm">Lihat Semua</a>
    </div>

    <div class="ts-product-slider slider-slick" data-section="terlaris">
      @foreach ($productTerlaris as $data)
      <div class="ts-product-card-wrap">
        <div class="ts-product-card">
          @foreach($data->images as $image)
            @if($image->is_thumb == 1)
            <div class="ts-product-img-wrap">
              <img src="{{ asset('assets/img/'.$image->imageName) }}" alt="{{ $data->name_product }}" class="ts-product-img">
              @if($data->sold_count > 10)
                <span class="ts-badge ts-product-badge ts-badge-danger">Terlaris</span>
              @endif
            </div>
            @endif
          @endforeach
          <div class="ts-product-body">
            <a href="{{ route('detail', $data->id) }}" class="ts-product-name">{{ Str::limit($data->name_product, 35) }}</a>
            <div class="ts-product-price">Rp {{ number_format($data->price, 0, '.', '.') }}</div>
            <div class="ts-product-meta">
              <span class="ts-product-stock {{ $data->stock > 0 ? 'in-stock' : 'out-stock' }}">
                {{ $data->stock > 0 ? 'Stok: '.$data->stock : 'Habis' }}
              </span>
              <span class="ts-product-sold">{{ $data->sold_count ?? 0 }} terjual</span>
            </div>
            <form action="{{ route('cart.add', $data->id) }}" method="POST">
              @csrf
              <input type="hidden" name="product_id" value="{{ $data->id }}">
              @if($data->stock == 0)
                <button class="ts-btn ts-btn-disabled w-100" disabled>Stok Habis</button>
              @else
                <button class="ts-btn ts-btn-primary w-100 ts-add-cart-btn" data-product-id="{{ $data->id }}">
                  <span class="material-symbols-outlined">add_shopping_cart</span>
                  Keranjang
                </button>
              @endif
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ===================== PRODUK TERJANGKAU ===================== --}}
<section class="ts-section">
  <div class="container">
    <div class="ts-section-header">
      <div>
        <h2 class="ts-section-title">
          <span class="material-symbols-outlined ts-title-icon">sell</span>
          Harga Terjangkau
        </h2>
        <p class="ts-section-subtitle">Kualitas terbaik dengan harga yang bersahabat</p>
      </div>
      <a href="{{ route('get.category', 2) }}" class="ts-btn ts-btn-outline-primary ts-btn-sm">Lihat Semua</a>
    </div>

    <div class="ts-product-slider slider-slick">
      @foreach ($productTerjangkau as $data)
      <div class="ts-product-card-wrap">
        <div class="ts-product-card">
          @foreach($data->images as $image)
            @if($image->is_thumb == 1)
            <div class="ts-product-img-wrap">
              <img src="{{ asset('assets/img/'.$image->imageName) }}" alt="{{ $data->name_product }}" class="ts-product-img">
              <span class="ts-badge ts-product-badge ts-badge-promo">Hemat</span>
            </div>
            @endif
          @endforeach
          <div class="ts-product-body">
            <a href="{{ route('detail', $data->id) }}" class="ts-product-name">{{ Str::limit($data->name_product, 35) }}</a>
            <div class="ts-product-price">Rp {{ number_format($data->price, 0, '.', '.') }}</div>
            <div class="ts-product-meta">
              <span class="ts-product-stock {{ $data->stock > 0 ? 'in-stock' : 'out-stock' }}">
                {{ $data->stock > 0 ? 'Stok: '.$data->stock : 'Habis' }}
              </span>
            </div>
            <form action="{{ route('cart.add', $data->id) }}" method="POST">
              @csrf
              <input type="hidden" name="product_id" value="{{ $data->id }}">
              @if($data->stock == 0)
                <button class="ts-btn ts-btn-disabled w-100" disabled>Stok Habis</button>
              @else
                <button class="ts-btn ts-btn-primary w-100">
                  <span class="material-symbols-outlined">add_shopping_cart</span>
                  Keranjang
                </button>
              @endif
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ===================== PRODUK TERBARU ===================== --}}
<section class="ts-section ts-section-alt">
  <div class="container">
    <div class="ts-section-header">
      <div>
        <h2 class="ts-section-title">
          <span class="material-symbols-outlined ts-title-icon">new_releases</span>
          Produk Terbaru
        </h2>
        <p class="ts-section-subtitle">Produk baru yang baru saja ditambahkan</p>
      </div>
    </div>

    <div class="ts-product-slider slider-slick">
      @foreach ($products as $data)
      <div class="ts-product-card-wrap">
        <div class="ts-product-card">
          @foreach($data->images as $image)
            @if($image->is_thumb == 1)
            <div class="ts-product-img-wrap">
              <img src="{{ asset('assets/img/'.$image->imageName) }}" alt="{{ $data->name_product }}" class="ts-product-img">
              <span class="ts-badge ts-product-badge ts-badge-new">Baru</span>
            </div>
            @endif
          @endforeach
          <div class="ts-product-body">
            <a href="{{ route('detail', $data->id) }}" class="ts-product-name">{{ Str::limit($data->name_product, 35) }}</a>
            <div class="ts-product-price">Rp {{ number_format($data->price, 0, '.', '.') }}</div>
            <div class="ts-product-meta">
              <span class="ts-product-stock {{ $data->stock > 0 ? 'in-stock' : 'out-stock' }}">
                {{ $data->stock > 0 ? 'Stok: '.$data->stock : 'Habis' }}
              </span>
            </div>
            <form action="{{ route('cart.add', $data->id) }}" method="POST">
              @csrf
              <input type="hidden" name="product_id" value="{{ $data->id }}">
              @if($data->stock == 0)
                <button class="ts-btn ts-btn-disabled w-100" disabled>Stok Habis</button>
              @else
                <button class="ts-btn ts-btn-primary w-100">
                  <span class="material-symbols-outlined">add_shopping_cart</span>
                  Keranjang
                </button>
              @endif
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ===================== TRUST BADGES ===================== --}}
<section class="ts-trust-section">
  <div class="container">
    <div class="ts-trust-grid">
      <div class="ts-trust-item">
        <span class="material-symbols-outlined">local_shipping</span>
        <div>
          <strong>Pengiriman Cepat</strong>
          <span>Ke seluruh Indonesia</span>
        </div>
      </div>
      <div class="ts-trust-item">
        <span class="material-symbols-outlined">verified_user</span>
        <div>
          <strong>Produk Terjamin</strong>
          <span>100% original & berkualitas</span>
        </div>
      </div>
      <div class="ts-trust-item">
        <span class="material-symbols-outlined">payments</span>
        <div>
          <strong>Pembayaran Aman</strong>
          <span>Midtrans & berbagai metode</span>
        </div>
      </div>
      <div class="ts-trust-item">
        <span class="material-symbols-outlined">support_agent</span>
        <div>
          <strong>Layanan Pelanggan</strong>
          <span>Siap membantu 24/7</span>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
