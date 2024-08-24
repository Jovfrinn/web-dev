@extends('fronsite.layouts.navbar')

@section('food-content')
<div class="container-beranda">
    <div class="nopad-beranda">
        <a href="#" class="link-beranda">Beranda</a><span class="material-symbols-outlined" style="color:white">
            arrow_forward
            </span>
            <p class="p-page">Halaman Minuman</p>
    </div>
</div>
<div class="sidebar">
    <a href="{{ route('category-air-mineral') }}">Minuman Air Mineral</a>
    <a href="{{ route('category-botol') }}">Minuman botol</a>
    <a href="{{ route('category-jus') }}">Minuman Jus</a>
    <a class="active" {{ Route::currentRouteName() == 'category-kopi' ? 'active' : '' }} href="{{ route('category-kopi') }}">Minuman Kopi</a>
    <a href="{{ route('category-minuman-ringan') }}">Minuman Ringan</a>
    <a href="{{ route('category-sirup') }}">Minuman Sirup</a>
    <a href="{{ route('category-susu') }}">Minuman Susu</a>
    <a href="{{ route('category-teh') }}">Minuman Teh</a>
  </div>

<div class="container">
    <div class="content">
        <div class="title-content">Minuman kopi</div>
        <div class="list slider-slick">
            <div class="card-list d-flex flex-column align-items-center">
                <img src="https://www.sunlight.co.id/images/h0nadbhvm6m4/1VLa8YgpNnTTHS8hVcRpFx/f877e731e3474ef8f0b991083e3d69a1/U3VubGlnaHRfSmVydWtfTmlwaXMxLnBuZw/1080w-1080h/sunlight-jeruk-nipis.jpg" alt="">
                <div class="title-produk">sunlight</div>
                <div class="price">Rp 21.500</div>
                </a>
                <button class="btn cart-btn"><span class="material-symbols-outlined">
                    add
                    </span>Keranjang</button>
            </div>
            <div class="card-list d-flex flex-column align-items-center">
                <img src="https://www.sunlight.co.id/images/h0nadbhvm6m4/1VLa8YgpNnTTHS8hVcRpFx/f877e731e3474ef8f0b991083e3d69a1/U3VubGlnaHRfSmVydWtfTmlwaXMxLnBuZw/1080w-1080h/sunlight-jeruk-nipis.jpg" alt="">
                <div class="title-produk">sunlight</div>
                <div class="price">Rp 21.500</div>
                </a>
                <button class="btn cart-btn"><span class="material-symbols-outlined">
                    add
                    </span>Keranjang</button>
            </div>
            <div class="card-list d-flex flex-column align-items-center">
                <img src="https://www.sunlight.co.id/images/h0nadbhvm6m4/1VLa8YgpNnTTHS8hVcRpFx/f877e731e3474ef8f0b991083e3d69a1/U3VubGlnaHRfSmVydWtfTmlwaXMxLnBuZw/1080w-1080h/sunlight-jeruk-nipis.jpg" alt="">
                <div class="title-produk">sunlight</div>
                <div class="price">Rp 21.500</div>
                </a>
                <button class="btn cart-btn"><span class="material-symbols-outlined">
                    add
                    </span>Keranjang</button>
            </div>
            <div class="card-list d-flex flex-column align-items-center">
                <img src="https://www.sunlight.co.id/images/h0nadbhvm6m4/1VLa8YgpNnTTHS8hVcRpFx/f877e731e3474ef8f0b991083e3d69a1/U3VubGlnaHRfSmVydWtfTmlwaXMxLnBuZw/1080w-1080h/sunlight-jeruk-nipis.jpg" alt="">
                <div class="title-produk">sunlight</div>
                <div class="price">Rp 21.500</div>
                </a>
                <button class="btn cart-btn"><span class="material-symbols-outlined">
                    add
                    </span>Keranjang</button>
            </div>
            <div class="card-list d-flex flex-column align-items-center">
                <img src="https://www.sunlight.co.id/images/h0nadbhvm6m4/1VLa8YgpNnTTHS8hVcRpFx/f877e731e3474ef8f0b991083e3d69a1/U3VubGlnaHRfSmVydWtfTmlwaXMxLnBuZw/1080w-1080h/sunlight-jeruk-nipis.jpg" alt="">
                <div class="title-produk">sunlight</div>
                <div class="price">Rp 21.500</div>
                </a>
                <button class="btn cart-btn"><span class="material-symbols-outlined">
                    add
                    </span>Keranjang</button>
            </div>
            <div class="card-list d-flex flex-column align-items-center">
                <img src="https://www.sunlight.co.id/images/h0nadbhvm6m4/1VLa8YgpNnTTHS8hVcRpFx/f877e731e3474ef8f0b991083e3d69a1/U3VubGlnaHRfSmVydWtfTmlwaXMxLnBuZw/1080w-1080h/sunlight-jeruk-nipis.jpg" alt="">
                <div class="title-produk">sunlight</div>
                <div class="price">Rp 21.500</div>
                </a>
                <button class="btn cart-btn"><span class="material-symbols-outlined">
                    add
                    </span>Keranjang</button>
            </div>
            <div class="card-list d-flex flex-column align-items-center">
                <img src="https://www.sunlight.co.id/images/h0nadbhvm6m4/1VLa8YgpNnTTHS8hVcRpFx/f877e731e3474ef8f0b991083e3d69a1/U3VubGlnaHRfSmVydWtfTmlwaXMxLnBuZw/1080w-1080h/sunlight-jeruk-nipis.jpg" alt="">
                <div class="title-produk">sunlight</div>
                <div class="price">Rp 21.500</div>
                </a>
                <button class="btn cart-btn"><span class="material-symbols-outlined">
                    add
                    </span>Keranjang</button>
            </div>
            </div>
        </div>
    </div>
    <script>
        function w3_open() {
          document.getElementById("mySidebar").style.display = "block";
        }

        function w3_close() {
          document.getElementById("mySidebar").style.display = "none";
        }
        </script>
@endsection

