@extends('backsite.layouts.sidebar')
@section('backContent')
<div class="container">
    <div class="content">
        <div class="title-content">Produk Terlaris</div>
        <div class="list">
            @foreach ($products as $data)
            <div class="card-list d-flex flex-column align-items-center">
                @foreach($data->images as $image)
                <img src="{{asset('assets/img/'.$image->imageName)}}" alt="">
                @endforeach
                <div class="title-produk"><a href="{{route('detail', $data->id)}}">{{$data['name_product']}}</a></div>
                <div class="price">Rp {{number_format($data->price,0,'.','.')}}</div>
                </a>
              
   <form action="{{ route('product.add.stock', $data->id) }}" method="POST">
    @csrf
    <input type="number" name="amount" placeholder="Jumlah yang ditambah">
    <button type="submit">Tambah Stok</button>
</form>

<form action="{{ route('product.reduce.stock', $data->id) }}" method="POST">
    @csrf
    <input type="number" name="amount" placeholder="Jumlah yang dikurangi">
    <button type="submit">Kurangi Stok</button>
</form>
            </div>
            @endforeach
        
            </div>
        </div>
    </div>
  </div>
  @endsection