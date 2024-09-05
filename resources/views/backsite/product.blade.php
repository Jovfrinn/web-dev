@extends('backsite.layouts.sidebar')
@section('backContent')
<div class="section-products container">
  <div class="title-products">Dashboard</div>
  <div class="table-product">
    <table class="table-dashboard " border="0" colspan="0" rowspan="1">
      <thead>
        <th class="field-id">ID</th>
        <th class="field-gambar">Gambar</th>
        <th class="field-name">Nama_Product</th>
        <th class="field-desc">Deskripsi</th>
        <th class="field-harga">Harga</th>
        <th class="field-stock">Stok Barang</th>
        <th class="field-kategori">Kategori</th>
        <th class="field-aksi">Aksi</th>
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