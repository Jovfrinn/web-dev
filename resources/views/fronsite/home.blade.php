@extends('fronsite.layouts.navbar')
@section('content')

<div class="poster">
    <img src="https://i.pinimg.com/550x/6c/d3/38/6cd3383fa546a1d8d53d58191e500249.jpg" class="img-poster">
</div>

  <div class="container">
    <div class="content">
        <div class="title-content">Produk Terlaris</div>
        <div class="list slider-slick">
            @foreach ($products as $data)
            <div class="card-list d-flex flex-column align-items-center">
                @foreach($data->images as $image)
                @if($image->is_thumb == 1)
                <img src="{{asset('assets/img/'.$image->imageName)}}" alt="">
                @endif
                @endforeach
                <div class="title-produk"><a href="{{route('detail', $data->id)}}">{{$data['name_product']}}</a></div>
                <div class="price">Rp {{number_format($data->price,0,'.','.')}}</div>
                </a>
                <form action="{{route('cart.add',$data->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$data->id}}">
                    @if($data->stock == 0)
                <button class="btn cart-btn add-to-cart" disabled data-product-id="{{ $data->id }}"><span class="material-symbols-outlined">
                    add
                    </span>Keranjang</button>
                    @else 
                    <button class="btn cart-btn add-to-cart" data-product-id="{{ $data->id }}"><span class="material-symbols-outlined">
                        add
                        </span>Keranjang</button>
                    @endif
                </form>
            </div>
            @endforeach
            <div class="card-list d-flex flex-column align-items-center">
                <img src="https://www.sunlight.co.id/images/h0nadbhvm6m4/1VLa8YgpNnTTHS8hVcRpFx/f877e731e3474ef8f0b991083e3d69a1/U3VubGlnaHRfSmVydWtfTmlwaXMxLnBuZw/1080w-1080h/sunlight-jeruk-nipis.jpg" alt="">
                <div class="title-produk">sunlight</div>
                <div class="price">Rp 21.500</div>
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
  </div>


@endsection