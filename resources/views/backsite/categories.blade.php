@extends('backsite.layouts.sidebar')
@section('title', 'Manajemen Kategori')
@section('breadcrumb')
  <span>Kategori</span>
@endsection
@section('content')
<div class="admin-page-header mb-4">
  <h1 class="admin-page-title">Manajemen Kategori</h1>
  <p class="admin-page-subtitle">Kelola klasifikasi produk Anda di sini.</p>
</div>

<div class="row g-4">
  <!-- Form Tambah Kategori -->
  <div class="col-lg-4">
    <div class="admin-card border-0 shadow-sm" style="border-radius: 16px;">
      <div class="admin-card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
        <h5 class="fw-bold mb-0">
          <span class="material-symbols-outlined align-middle me-2 text-primary" style="font-size: 22px;">add_circle</span>
          Tambah Kategori
        </h5>
      </div>
      <form action="{{ route('admin.categories.store') }}" method="POST" class="admin-card-body p-4">
        @csrf
        @if($errors->any())
          <div class="alert alert-danger" style="border-radius: 8px;">{{ $errors->first() }}</div>
        @endif
        <div class="mb-4">
          <label class="form-label fw-semibold text-dark">Nama Kategori</label>
          <input type="text" name="name_categories" class="form-control form-control-lg bg-light border-0" style="font-size: 15px;" placeholder="Contoh: Sepatu Sneakers" required value="{{ old('name_categories') }}">
        </div>
        <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold d-flex align-items-center justify-content-center gap-2" style="border-radius: 8px; background-color: var(--ts-primary); border: none;">
          <span class="material-symbols-outlined" style="font-size: 20px;">save</span>
          Simpan Kategori
        </button>
      </form>
    </div>
  </div>

  <!-- Tabel Kategori -->
  <div class="col-lg-8">
    <div class="admin-card border-0 shadow-sm" style="border-radius: 16px;">
      <div class="admin-card-header bg-transparent border-bottom-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Semua Kategori</h5>
        <span class="badge rounded-pill bg-primary-subtle text-primary" style="font-weight: 600; padding: 6px 12px;">{{ $categories->count() }} kategori</span>
      </div>
      <div class="admin-card-body p-0">
        <table class="admin-table">
          <thead>
            <tr>
              <th style="padding-left: 24px;">No</th>
              <th>Nama Kategori</th>
              <th>Jumlah Produk</th>
              <th class="text-end" style="padding-right: 24px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php $i = 1; @endphp
            @forelse($categories as $cat)
            <tr>
              <td style="padding-left: 24px;"><strong>{{ $i++ }}</strong></td>
              <td><span class="fw-semibold text-dark">{{ $cat->name_categories }}</span></td>
              <td>
                <span class="badge rounded-pill bg-info-subtle text-info" style="font-weight: 600; padding: 5px 10px; font-size: 12px;">
                  {{ $cat->products_count }} produk
                </span>
              </td>
              <td class="text-end" style="padding-right: 24px;">
                <div class="d-flex gap-1 justify-content-end">
                  <button type="button" class="admin-btn admin-btn-ghost admin-btn-sm" onclick="editCategory({{ $cat->id }}, '{{ $cat->name_categories }}')" title="Edit Kategori">
                    <span class="material-symbols-outlined text-primary">edit</span>
                  </button>
                  <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua produk di dalamnya mungkin akan terdampak.')">
                    @csrf @method('DELETE')
                    <button class="admin-btn admin-btn-ghost admin-btn-sm" title="Hapus Kategori">
                      <span class="material-symbols-outlined text-danger">delete</span>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="4" class="text-center py-5 text-muted">
                <div class="d-flex flex-column align-items-center">
                  <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                    <span class="material-symbols-outlined text-muted" style="font-size: 32px;">category</span>
                  </div>
                  <h6 class="fw-bold text-dark mb-1">Belum Ada Kategori</h6>
                  <p class="text-muted fs-7 mb-0">Silakan tambahkan kategori baru melalui form di samping.</p>
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0 shadow" style="border-radius: 16px;">
      <div class="modal-header border-bottom-0 pb-0">
        <h5 class="modal-title fw-bold">Edit Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="editForm" method="POST">
        @csrf @method('PUT')
        <div class="modal-body pt-3 pb-4">
          <label class="form-label fw-semibold text-dark">Nama Kategori</label>
          <input type="text" name="name_categories" id="editCatName" class="form-control form-control-lg bg-light border-0" style="font-size: 15px;" required>
        </div>
        <div class="modal-footer border-top-0 pt-0 pb-4">
          <button type="button" class="btn btn-light rounded-3 fw-semibold px-4" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary rounded-3 fw-semibold px-4" style="background-color: var(--ts-primary); border: none;">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
function editCategory(id, name) {
  document.getElementById('editCatName').value = name;
  document.getElementById('editForm').action = '/backsite/categories/' + id;
  new bootstrap.Modal(document.getElementById('editModal')).show();
}
</script>
@endsection
