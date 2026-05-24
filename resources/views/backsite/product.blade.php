@extends('backsite.layouts.sidebar')
@section('title', 'Manajemen Produk')
@section('content')

<div class="admin-page-header">
  <h1 class="admin-page-title">Manajemen Produk</h1>
</div>

<div class="admin-card">
  <div class="admin-card-header">
    <h3 class="admin-card-title">Semua Produk</h3>
    <div class="d-flex gap-2">
      <!-- You can implement real search filter later -->
      <form action="{{ route('get.product.backsite') }}" method="GET" class="d-flex gap-2">
        <input type="text" name="search" class="admin-form-control" placeholder="Cari produk..." value="{{ request('search') }}" style="width:200px">
        <button type="submit" class="admin-btn admin-btn-primary">Cari</button>
      </form>
      <a href="{{ route('add.product.backsite') }}" class="admin-btn admin-btn-primary">
        <span class="material-symbols-outlined">add</span> Tambah Produk
      </a>
    </div>
  </div>
  
  <div class="admin-card-body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Produk</th>
          <th>Deskripsi</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($products as $index => $product)
        <tr>
          <td>{{ $products->firstItem() + $index }}</td>
          <td>
            <div class="admin-product-cell">
              @php $hasImage = false; @endphp
              @foreach ($product->images as $image)
                @if($image->is_thumb == 1)
                  <img class="admin-img-thumb" src="{{ asset('assets/img/'.$image->imageName) }}" alt="{{ $product->name_product }}">
                  @php $hasImage = true; @endphp
                  @break
                @endif
              @endforeach
              @if(!$hasImage)
                 <div class="admin-img-thumb d-flex align-items-center justify-content-center bg-light text-muted">
                    <span class="material-symbols-outlined">image</span>
                 </div>
              @endif
              <div class="d-flex flex-column">
                <span class="fw-semibold">{{ Str::limit($product->name_product, 30) }}</span>
                <small class="text-muted">{{ $product->category->name_categories ?? 'Kategori' }}</small>
              </div>
            </div>
          </td>
          <td>
             <span class="text-muted" title="{{ $product->description_product }}">
               {{ Str::limit($product->description_product, 30) }}
             </span>
          </td>
          <td><strong>Rp {{ number_format($product->price, 0, '.', '.') }}</strong></td>
          <td>
             @if($product->stock > 5)
               <span class="admin-badge admin-badge-success">{{ number_format($product->stock, 0, '.', '.') }}</span>
             @elseif($product->stock > 0)
               <span class="admin-badge admin-badge-warning">{{ number_format($product->stock, 0, '.', '.') }}</span>
             @else
               <span class="admin-badge admin-badge-danger">Habis</span>
             @endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('edit.product.backsite', $product->id) }}" class="admin-btn admin-btn-ghost admin-btn-sm" title="Edit">
                <span class="material-symbols-outlined">edit</span>
              </a>
              <form action="{{ route('delete.product.backsite', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="admin-btn admin-btn-danger admin-btn-sm" title="Hapus">
                  <span class="material-symbols-outlined">delete</span>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-4 text-muted">
             <div class="admin-empty-state">
                <span class="material-symbols-outlined">inventory_2</span>
                <p>Belum ada produk</p>
             </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->hasPages())
  <div class="admin-card-body d-flex justify-content-end">
    {{ $products->links() }}
  </div>
  @endif
</div>

@endsection