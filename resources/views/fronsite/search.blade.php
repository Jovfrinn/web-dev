@extends('fronsite.layouts.navbar')
@section('content')
    <h1 style="font-size:20px; justify-content:center; text-align:center; margin-top:12px;"><span class="material-symbols-outlined">
        manage_search
        </span>Hasil Pencarian untuk '{{ $query  }}'</h1>
    <div class="container-search">
        <div class="content-search">
            <div class="title-content-search"></div>
            {{-- <div class="list slider-slick"> --}}
                @foreach ($products as $data)
                <div class="card-list-search d-flex flex-column mx-3 align-items-center">
                    @foreach($data->images as $image)
                    @if($image->is_thumb == 1)
                    <img src="{{asset('assets/img/'.$image->imageName)}}" alt="">
                    @endif
                    @endforeach
                    <div class="title-produk-search"><a href="{{route('detail', $data->id)}}">{{Str::limit($data['name_product'],8)}}</a></div>
                    <div class="price-search">Rp {{number_format($data->price,0,'.','.')}}</div>
                    </a>
                    <form action="{{route('cart.add',$data->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$data->id}}">
                    <button class="btn cart-btn add-to-cart" data-product-id="{{ $data->id }}"><span class="material-symbols-outlined">
                        add
                        </span>Keranjang</button>
                    </form>
                </div>
                @endforeach

@if($products->isEmpty())
    <p>Tidak ada produk yang ditemukan.</p>
@else
@endif
@endsection
