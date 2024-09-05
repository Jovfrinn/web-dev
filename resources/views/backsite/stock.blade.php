@extends('backsite.layouts.sidebar')
@section('backContent')
    <div class="section-products container">
        <div class="title-products">Stok Produk</div>
        <div class="table-product">
            <table class="table-dashboard " border="0" colspan="0" rowspan="1">
                <thead>
                    <th class="field-id">ID</th>
                    <th class="field-gambar">Gambar</th>
                    <th class="field-name">Nama_Product</th>
                    <th class="field-stock">Stok Barang</th>
                    <th class="field-actionStock">Aksi Stock</th>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $i++ }}</td>
                            @foreach ($product->images as $image)
                                @if ($image->is_thumb == 1)
                                    <td><img class="img-table" src="{{ asset('assets/img/' . $image->imageName) }}"
                                            alt=""></td>
                                @endif
                            @endforeach
                            <td>{{ $product->name_product }}</td>
                            <td>{{ number_format($product->stock, 0, '.', '.') }}</td>
                            <td>
                                <div class="button-stock">
                                    <form action="{{route('show.stock', $product->id)}}" method="GET">
                                    <button type="submit" class="btn btn-stock">Edit Stok</button>
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
