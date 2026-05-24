@extends('backsite.layouts.sidebar')
@section('title', 'Manajemen Stok')
@section('breadcrumb')
  <span>Manajemen Stok</span>
@endsection
@section('content')

<div class="admin-page-header">
  <h1 class="admin-page-title">Manajemen Stok Produk</h1>
</div>

<div class="admin-card">
  <div class="admin-card-header">
    <h3 class="admin-card-title">Stok Barang</h3>
    <div class="d-flex gap-2">
      <form action="{{ route('get.stock') }}" method="GET" class="d-flex gap-2">
        <input type="text" name="search" class="admin-form-control" placeholder="Cari produk..." value="{{ request('search') }}" style="width:200px">
        <button type="submit" class="admin-btn admin-btn-primary">Cari</button>
      </form>
    </div>
  </div>
  
  <div class="admin-card-body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Gambar</th>
          <th>Nama Produk</th>
          <th>Stok Tersedia</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($products as $index => $product)
        <tr>
          <td><strong>{{ $products->firstItem() + $index }}</strong></td>
          <td>
            @php $hasImage = false; @endphp
            @foreach ($product->images as $image)
              @if ($image->is_thumb == 1)
                <img class="admin-img-thumb" src="{{ asset('assets/img/' . $image->imageName) }}" alt="{{ $product->name_product }}">
                @php $hasImage = true; break; @endphp
              @endif
            @endforeach
            @if(!$hasImage)
               <div class="admin-img-thumb d-flex align-items-center justify-content-center bg-light text-muted">
                  <span class="material-symbols-outlined">image</span>
               </div>
            @endif
          </td>
          <td><strong>{{ $product->name_product }}</strong></td>
          <td>
             @if($product->stock > 5)
               <span class="admin-badge admin-badge-success">{{ number_format($product->stock, 0, '.', '.') }} unit</span>
             @elseif($product->stock > 0)
               <span class="admin-badge admin-badge-warning">{{ number_format($product->stock, 0, '.', '.') }} unit</span>
             @else
               <span class="admin-badge admin-badge-danger">Habis</span>
             @endif
          </td>
          <td>
            <a href="{{ route('show.stock', $product->id) }}" class="admin-btn admin-btn-ghost admin-btn-sm" title="Edit Stok">
              <span class="material-symbols-outlined text-primary">edit_square</span>
              <span class="d-none d-md-inline ms-1">Kelola Stok</span>
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center py-4 text-muted">Belum ada data produk</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@if($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->hasPages())
<div class="admin-card-body d-flex justify-content-end mt-3 border-top pt-3 bg-white shadow-sm" style="border-radius: 8px;">
  {{ $products->appends(['search' => request('search')])->links() }}
</div>
@endif

@endsection
