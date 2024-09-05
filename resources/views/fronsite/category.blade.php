@extends('fronsite.layouts.navbar')
@section('content')
<div class="kategori-container">
    <h2>KATEGORI</h2>
    <div class="kategori-list">
      @foreach(getCategory() as $category)
      <div class="kategori-item">
        <div class="kategori-icon">
            @if($category->id == 1)
            <img src="{{ asset('assets/img/fast-food.png') }}" alt="Food Icon" class="icon">
            @elseif($category->id == 2)
            <img src="{{ asset('assets/img/soft-drink.png') }}" alt="Drink Icon" class="icon">
            @elseif($category->id == 3)
            <img src="{{ asset('assets/img/graduation-hat.png') }}" alt="Perlengkapan sekolah" class="icon">
            @elseif($category->id == 4)
            <img src="{{ asset('assets/img/uniform.png') }}" alt="Fashion" class="icon">
            @else
            <img src="{{ asset('assets/img/') }}" alt="Default Icon">
            @endif
        </div>
        <a href="{{route('get.category',$category->id)}}" style="color:black;" class="{{ Request::is('category/' . $category->id) ? 'active' : '' }}">{{$category->name_categories}}</a>
      </div>
      @endforeach
    </div>
  </div>


<div class="container-produkTerlaris">
    <div class="content-produkTerlaris">
        <div class="title-content">{{ $categories->name_categories }}</div>
        <div class="list slider-slick">
            @foreach ($products as $product)
            <div class="card-list d-flex flex-column align-items-center">
                @foreach($product->images as $image)
                {{-- @foreach ($product->images as $image) --}}
                {{-- @dd($images) --}}
                @if($image->is_thumb == 1)
                {{-- <img src="{{asset('assets/img/'.$image->imageName)}}" alt=""> --}}
                {{-- @foreach ($product->images as $image) --}}
                {{-- @dd($images) --}}
                <img src="{{asset('assets/img/'.$image->imageName)}}" alt="">
                @endif
                @endforeach
                <div class="title-produk">{{$product->name_product}}</div>
                <div class="price">Rp {{number_format($product->price,0,'.','.')}}</div>
                </a>
                <form action="{{route('cart.add',$product->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                <button class="btn cart-btn add-to-cart" data-product-id="{{ $product->id }}"><span class="material-symbols-outlined">
                    add
                    </span>Keranjang</button>
                </form>
            </div>
            @endforeach
            {{-- @endforeach --}}
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
        // function w3_open() {
        //   document.getElementById("mySidebar").style.display = "block";
        // }

        // function w3_close() {
        //   document.getElementById("mySidebar").style.display = "none";
        // }
        // </script>
@endsection


