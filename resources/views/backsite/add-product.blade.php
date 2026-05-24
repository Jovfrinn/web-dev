@extends('backsite.layouts.sidebar')
@section('title', 'Tambah Produk')
@section('breadcrumb')
  <a href="{{ route('get.product.backsite') }}">Semua Produk</a>
  <span class="material-symbols-outlined sep">chevron_right</span>
  <span>Tambah Produk</span>
@endsection
@section('content')

<div class="admin-page-header">
  <h1 class="admin-page-title">Tambah Produk Baru</h1>
  <p class="admin-page-subtitle">Lengkapi informasi di bawah ini untuk menambahkan produk ke etalase toko.</p>
</div>

<form action="{{ route('post.product.backsite') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    <!-- Kolom Kiri: Informasi Dasar -->
    <div class="col-lg-8">
      <div class="admin-card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="admin-card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
          <h5 class="fw-bold mb-0">
            <span class="material-symbols-outlined align-middle me-2 text-primary" style="font-size: 22px;">edit_document</span>
            Informasi Dasar
          </h5>
        </div>
        <div class="admin-card-body p-4">
          
          <div class="mb-4">
            <label for="name_product" class="form-label fw-semibold text-dark">Nama Produk <span class="text-danger">*</span></label>
            <input type="text" id="name_product" name="name_product" class="form-control form-control-lg bg-light border-0" style="font-size: 15px;" required placeholder="Contoh: Sepatu Sneakers Pria Premium">
          </div>

          <div class="mb-4">
            <label for="description_product" class="form-label fw-semibold text-dark">Deskripsi Lengkap <span class="text-danger">*</span></label>
            <textarea id="description_product" name="description_product" class="form-control bg-light border-0" style="font-size: 15px; min-height: 180px;" required placeholder="Jelaskan spesifikasi, bahan, dan keunggulan produk ini..."></textarea>
          </div>

          <div class="mb-2">
            <label for="category_id" class="form-label fw-semibold text-dark">Kategori <span class="text-danger">*</span></label>
            <select id="category_id" name="category_id" class="form-select form-select-lg bg-light border-0" style="font-size: 15px;" required>
              <option value="" disabled selected>-- Pilih Kategori yang Sesuai --</option>
              @foreach (getCategory() as $category)
                <option value="{{ $category->id }}">{{ $category->name_categories }}</option>
              @endforeach
            </select>
          </div>

        </div>
      </div>
    </div>

    <!-- Kolom Kanan: Media & Pricing -->
    <div class="col-lg-4">
      
      <!-- Card Media -->
      <div class="admin-card border-0 shadow-sm mb-4" style="border-radius: 16px;">
        <div class="admin-card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
          <h5 class="fw-bold mb-0">
            <span class="material-symbols-outlined align-middle me-2 text-primary" style="font-size: 22px;">image</span>
            Media Produk
          </h5>
        </div>
        <div class="admin-card-body p-4">
          <label class="form-label fw-semibold text-dark">Upload Gambar <span class="text-danger">*</span></label>
          <div class="position-relative">
            <input type="file" id="image" name="image[]" class="form-control" multiple required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 2;">
            <div class="d-flex flex-column align-items-center justify-content-center bg-light rounded-3 p-4 text-center border" style="border-style: dashed !important; border-width: 2px !important; border-color: #cbd5e1 !important;">
              <span class="material-symbols-outlined text-muted mb-2" style="font-size: 40px;">cloud_upload</span>
              <span class="fw-medium text-dark">Klik atau seret gambar ke sini</span>
              <small class="text-muted mt-1">Format: JPG, PNG, WEBP (Max: 2MB)</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Card Harga & Stok -->
      <div class="admin-card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="admin-card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
          <h5 class="fw-bold mb-0">
            <span class="material-symbols-outlined align-middle me-2 text-primary" style="font-size: 22px;">sell</span>
            Harga & Stok
          </h5>
        </div>
        <div class="admin-card-body p-4">
          
          <div class="mb-4">
            <label for="price_display" class="form-label fw-semibold text-dark">Harga Satuan <span class="text-danger">*</span></label>
            <div class="input-group input-group-lg">
              <span class="input-group-text bg-light border-0 text-muted fw-bold">Rp</span>
              <input type="text" id="price_display" class="form-control bg-light border-0" style="font-size: 15px;" required placeholder="0">
              <input type="hidden" id="price" name="price">
            </div>
          </div>

          <div class="mb-4">
            <label for="stock" class="form-label fw-semibold text-dark">Stok Awal <span class="text-danger">*</span></label>
            <input type="number" id="stock" name="stock" class="form-control form-control-lg bg-light border-0" style="font-size: 15px;" required placeholder="0">
          </div>

        </div>
      </div>

    </div>
  </div>

  <!-- Floating Action Bar -->
  <div class="position-sticky bottom-0 bg-white py-3 px-4 border-top shadow-sm d-flex justify-content-end gap-3 mt-4" style="z-index: 100; margin-left: -28px; margin-right: -28px; margin-bottom: -28px;">
    <a href="{{ route('get.product.backsite') }}" class="btn btn-light btn-lg px-4 fw-semibold" style="border-radius: 8px;">Batal</a>
    <button type="submit" class="btn btn-primary btn-lg px-5 fw-semibold d-flex align-items-center gap-2" style="border-radius: 8px; background-color: var(--ts-primary); border: none;">
      <span class="material-symbols-outlined" style="font-size: 20px;">save</span>
      Simpan Produk
    </button>
  </div>
</form>

@endsection

@section('script')
<script>
  const priceDisplay = document.getElementById('price_display');
  const priceInput = document.getElementById('price');

  priceDisplay.addEventListener('input', function(e) {
      let value = this.value.replace(/[^0-9]/g, '');
      priceInput.value = value;
      if (value) {
          this.value = parseInt(value, 10).toLocaleString('id-ID');
      } else {
          this.value = '';
      }
  });
</script>
@endsection