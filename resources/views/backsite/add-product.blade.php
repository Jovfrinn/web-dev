@extends('backsite.layouts.sidebar')
@section('backContent')
<div class="form-container">
    <h1>Tambah Produk Baru</h1>
    <form action="{{route('post.product.backsite')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name_product">Nama Produk:</label>
            <input type="text" id="name_product" name="name_product" required>
        </div>

        <div class="form-group">
            <label for="image">Upload Gambar:</label>
            <input type="file" id="image" name="image[]" multiple required>
        </div>

        <div class="form-group">
            <label for="description_product">Deskripsi Produk:</label>
            <textarea id="description_product" name="description_product" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Harga Produk:</label>
            <input type="number" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="stock">Stok Produk:</label>
            <input type="number" id="stock" name="stock" required>
        </div>

        <div class="form-group">
            <label for="category_id">Kategori Produk:</label>
            <select id="category_id" name="category_id" required>
                <option value="">Pilih Kategori</option>
                @foreach (getCategory() as $category)
                <option value="{{$category->id}}">{{$category->name_categories}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Simpan Produk</button>
    </form>
</div>
@endsection