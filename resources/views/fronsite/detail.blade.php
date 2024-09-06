@extends('fronsite.layouts.navbar')
@section('content')
<div class="detail-productss" style="background-color: rgb(215, 215, 215)">
<div class="container">
    <div class="row mx-auto detail-product-img">
        <div class="col-md-4 d-flex flex-column justify-content-center">
            <div class="slider-detail">
            @foreach($detail_product->images as $image)
            <img  src="{{asset('assets/img/'.$image->imageName)}}" class="img-detail">
            @endforeach
            </div>
            <div class="section-image">
            @foreach($detail_product->images as $image)
            <div class="section-img">
                <img src="{{asset('assets/img/'.$image->imageName)}}" class="img-support">
            </div>
            @endforeach
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div class="detail-product">
                <div class="title-product">{{$detail_product->name_product}}</div>
                <div class="ready-stock">Stock {{$detail_product->stock}}</div>
                <div class="price-product">{{number_format($detail_product->price,0,'.','.')}}</div>
                <form action="{{route('cart.add',$detail_product->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$detail_product->id}}">
                    @if($detail_product->stock == 0)
                <button class="btn cart-btn add-to-cart" disabled data-product-id="{{ $detail_product->id }}"><span class="material-symbols-outlined">
                    add
                    </span>Keranjang</button>
                    @else
                    <button class="btn cart-btn add-to-cart" data-product-id="{{ $detail_product    ->id }}"><span class="material-symbols-outlined">
                        add
                        </span>Keranjang</button>
                    @endif
                </form>
            </div>

            <div class="detail-description">
                <div class="description-title">Deskripsi</div>
                    <div class="text-description">{{$detail_product->description_product}}</div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script>
    $('.slider-detail').slick();
</script>
@endsection