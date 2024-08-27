@extends('fronsite.layouts.navbar')
@section('content')
<div class="detail" style="background-color: rgb(215, 215, 215)">
<div class="container">
    <div class="row mx-auto detail-product-img">
        <div class="col-md-4">
            @foreach($detail_product->images as $image)
            <img  src="{{asset('assets/img/'.$image->imageName)}}" class="img-detail">
            @endforeach
            @foreach($detail_product->images as $image)
            <div class="section-img">
                <img src="{{asset('assets/img/'.$image->imageName)}}" class="img-support">
            </div>
            @endforeach
        </div>
        <div class="col-md-8">
            <div class="detail-product">
                <div class="title-product">{{$detail_product->name_product}}</div>
                <div class="ready-stock">Stock {{$detail_product->stock}}</div>
                <div class="price-product">{{number_format($detail_product->price,0,'.','.')}}</div>
                <div class="quantity">
                    <form>
                        <label for="quantity">Quantity : </label>
                        <input type="number" id="quantity" name="quantity" min="1" max="10">
                    </form>
                </div>
                <div class="btn-productCart"><a href="#"><span class="material-symbols-outlined">
                    add
                    </span>Keranjang</a></div>
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