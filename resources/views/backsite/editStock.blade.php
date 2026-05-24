@extends('backsite.layouts.sidebar')
@section('title', 'Edit Stok')
@section('breadcrumb')
  <a href="{{ route('get.stock') }}">Manajemen Stok</a>
  <span class="material-symbols-outlined sep">chevron_right</span>
  <span>Kelola Stok</span>
@endsection
@section('content')

<div class="admin-page-header">
  <h1 class="admin-page-title">Kelola Stok Produk</h1>
</div>

<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="admin-card text-center p-4">
      
      <div class="mb-4">
        @php $hasImage = false; @endphp
        @foreach($products->images as $image)
          @if($image->is_thumb == 1)
            <img src="{{ asset('assets/img/'.$image->imageName) }}" alt="{{ $products->name_product }}" class="img-fluid rounded shadow-sm" style="max-height: 200px; object-fit: contain;">
            @php $hasImage = true; break; @endphp
          @endif
        @endforeach
        @if(!$hasImage)
          <div class="d-flex align-items-center justify-content-center bg-light rounded mx-auto text-muted" style="height:200px; width:200px;">
            <span class="material-symbols-outlined" style="font-size: 64px;">image</span>
          </div>
        @endif
      </div>

      <h3 class="fw-bold mb-2">{{ $products->name_product }}</h3>
      
      <div class="mb-4">
        <span class="admin-badge {{ $products->stock > 5 ? 'admin-badge-success' : ($products->stock > 0 ? 'admin-badge-warning' : 'admin-badge-danger') }} px-3 py-2" style="font-size: 14px;">
          Sisa Stok: {{ number_format($products->stock, 0, '.', '.') }} unit
        </span>
      </div>

      <div class="border-top pt-4">
        <form action="{{ route('product.edit.stock', $products->id) }}" method="POST">
          @csrf
          <label class="form-label fw-semibold text-muted mb-3">Sesuaikan Jumlah Stok</label>
          
          <div class="d-flex justify-content-center align-items-center gap-3 mb-4">
            <button type="button" class="admin-btn admin-btn-ghost rounded-circle p-2" id="decrease" style="width: 48px; height: 48px;">
              <span class="material-symbols-outlined m-0" style="font-size: 24px;">remove</span>
            </button>
            
            <input type="number" name="quantityStock" value="{{ $products->stock }}" min="0" id="qtyInput" class="admin-form-control text-center fs-4 fw-bold" style="width: 100px; height: 56px;">
            
            <button type="button" class="admin-btn admin-btn-ghost rounded-circle p-2" id="increase" style="width: 48px; height: 48px;">
              <span class="material-symbols-outlined m-0" style="font-size: 24px;">add</span>
            </button>
          </div>

          <div class="d-flex justify-content-center gap-2">
            <a href="{{ route('get.stock') }}" class="admin-btn admin-btn-ghost px-4">Kembali</a>
            <button type="submit" class="admin-btn admin-btn-primary px-5">Simpan Perubahan</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

@endsection

@section('script')
<script>
  const qtyInput = document.getElementById('qtyInput');
  const decreaseBtn = document.getElementById('decrease');
  const increaseBtn = document.getElementById('increase');

  decreaseBtn.addEventListener('click', function() {
      let currentValue = parseInt(qtyInput.value) || 0;
      if (currentValue > 0) { 
          qtyInput.value = currentValue - 1;
      }
  });

  increaseBtn.addEventListener('click', function() {
      let currentValue = parseInt(qtyInput.value) || 0;
      qtyInput.value = currentValue + 1; 
  });
</script>
@endsection
