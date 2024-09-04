@extends('backsite.layouts.sidebar')
@section('backContent')
<div class="section-products container">
  <div class="title-products">Dashboard</div>
  <div class="table-product mx-auto">
    <table class="table-dashboard mx-auto" border="0" colspan="0" rowspan="1">
      <thead>
        <th>ID</th>
        <th>Gambar</th>
        <th>Nama_Product</th>
        <th class="desc-product">Deskripsi</th>
        <th>Harga</th>
        <th>Stok Barang</th>
        <th>Kategori</th>
        <th>Aksi</th>
      </thead>
      <tbody>
        @php $i = 1; @endphp
        @foreach ($products as $product)
        <tr>
          <td>{{$i++}}</td>
          @foreach ($product->images as $image)
          @if($image->is_thumb == 1)
          <td><img class="img-table" src="{{asset('assets/img/'.$image->imageName)}}" alt=""></td>
          @endif
          @endforeach
          <td>{{$product->name_product}}</td>
          <td class="desc-product1">{{$product->description_product}}</td>
          <td>Rp {{number_format($product->price,0,'.','.')}}</td>
          <td>{{number_format($product->stock,0,'.','.')}}</td>
          <td>Makan</td>
          <td>
            <div class="button-editDelete">
              <a href="{{route('edit.product.backsite',$product->id)}}" action="POST" class="btn btn-edit"><span class="material-symbols-outlined">
                edit
                </span></a>
                <form action="{{route('delete.product.backsite',$product->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-delete"><span class="material-symbols-outlined">
                    delete
                    </span></button>
                </form>
            </div>
        </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection