@extends('fronsite.layouts.navbar')

@section('content')
<div class="sidebar">
    @foreach(getCategory() as $category)
    <a href="{{route('get.category',$category->id)}}" class="{{ Request::is('category/' . $category->id) ? 'active' : '' }}">{{$category->name_categories}}</a>
    @endforeach
  </div>

<div class="container">
    <div class="content">
        <div class="title-content">{{ $categories->name_categories }}</div>
        <div class="list slider-slick">
            @foreach ($products as $product)
            <div class="card-list d-flex flex-column align-items-center">
                @foreach ($product->images as $image)
                {{-- @dd($images) --}}
                <img src="{{asset('assets/img/'.$image->imageName)}}" alt="">
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

