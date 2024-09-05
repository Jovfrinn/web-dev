@extends('backsite.layouts.sidebar')
@section('backContent')
<h1 class="title-form">Tambah Produk Baru</h1>
<div class="form-container">
    <div class="icon-addProduct">
        <span class="material-symbols-outlined">
            box_add
            </span>
    </div>
    <form action="{{route('post.product.backsite')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name_product">Nama Produk</label>
            <input type="text" id="name_product" name="name_product" required placeholder="Masukkan Nama Produk">
        </div>

        <div class="form-group">
            <label for="image">Upload Gambar</label>
            <input type="file" id="image" name="image[]" multiple required>
        </div>

        <div class="form-group">
            <label for="description_product">Deskripsi Produk</label>
            <textarea id="description_product" name="description_product" required placeholder="Masukkan Deskripsi Produk"></textarea>
        </div>

        <div class="form-group">
            <label for="price">Harga Produk</label>
            <input type="number" id="price" name="price" required placeholder="Masukkan Harga Produk">
        </div>
        <div class="form-group">
            <label for="stock">Stok Produk</label>
            <input type="number" id="stock" name="stock" required placeholder="Masukkan Stock Produk">
        </div>

        <div class="form-group">
            <label for="category_id">Kategori Produk</label>
            <select id="category_id" name="category_id" required>
                <option value="">Pilih Kategori</option>
                @foreach (getCategory() as $category)
                <option value="{{$category->id}}">{{$category->name_categories}}</option>
                @endforeach
            </select>
        </div>
        <div class="buttonAdd-group">
        <button type="submit" class="btn button-add">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection