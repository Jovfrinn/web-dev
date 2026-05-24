@extends('fronsite.layouts.navbar')
@section('title', $detail_product->name_product . ' — TrendStore')
@section('content')

<style>
/* Tokopedia-like Detail Styles */
.tkp-text-main { color: #31353B; }
.tkp-text-muted { color: #6D7588; }
.tkp-text-green { color: #00AA5B; }
.tkp-bg-green { background-color: #00AA5B; }
.tkp-btn-primary { background: #00AA5B; color: white; border: none; font-weight: 700; transition: 0.2s; }
.tkp-btn-primary:hover { background: #008F4C; color: white; }
.tkp-btn-outline { background: white; color: #00AA5B; border: 1px solid #00AA5B; font-weight: 700; transition: 0.2s; }
.tkp-btn-outline:hover { background: #F3F4F5; color: #00AA5B; }

.tkp-gallery-main { width: 100%; aspect-ratio: 1/1; object-fit: cover; border-radius: 8px; border: 1px solid #E5E7E9; margin-bottom: 12px; }
.tkp-gallery-thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; cursor: pointer; border: 2px solid transparent; }
.tkp-gallery-thumb.active { border-color: #00AA5B; }

.tkp-title { font-size: 20px; font-weight: 700; line-height: 1.4; margin-bottom: 8px; }
.tkp-price { font-size: 28px; font-weight: 800; margin-bottom: 16px; }

.tkp-tabs { display: flex; border-bottom: 1px solid #E5E7E9; margin-bottom: 16px; }
.tkp-tab { padding: 12px 16px; font-weight: 700; cursor: pointer; color: #6D7588; border-bottom: 3px solid transparent; }
.tkp-tab.active { color: #00AA5B; border-bottom-color: #00AA5B; }

.tkp-floating-box { border: 1px solid #E5E7E9; border-radius: 8px; padding: 16px; position: sticky; top: 100px; box-shadow: 0 1px 6px 0 rgba(49,53,59,0.12); }
.tkp-qty-box { display: flex; align-items: center; border: 1px solid #BFC9D9; border-radius: 6px; overflow: hidden; height: 32px; width: fit-content; }
.tkp-qty-btn { width: 32px; height: 100%; border: none; background: white; font-weight: bold; font-size: 20px; color: #00AA5B; display: flex; align-items: center; justify-content: center; cursor: pointer; }
.tkp-qty-btn:disabled { color: #BFC9D9; cursor: not-allowed; }
.tkp-qty-input { width: 44px; height: 100%; border: none; text-align: center; font-size: 14px; font-weight: 600; color: #31353B; outline: none; -moz-appearance: textfield; border-left: 1px solid #BFC9D9; border-right: 1px solid #BFC9D9;}
.tkp-qty-input::-webkit-inner-spin-button, .tkp-qty-input::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }

.tkp-action-row { display: flex; align-items: center; justify-content: center; gap: 16px; margin-top: 16px; border-top: 1px solid #E5E7E9; padding-top: 16px; }
.tkp-action-item { display: flex; align-items: center; gap: 4px; font-weight: 600; color: #31353B; font-size: 14px; cursor: pointer; background: none; border: none; padding: 0; }
.tkp-action-item:hover { color: #00AA5B; }
</style>

<div class="ts-section" style="padding-top: 24px; padding-bottom: 60px;">
  <div class="container">
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb" style="font-size: 14px;">
        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-success text-decoration-none">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('get.category', $detail_product->category_id) }}" class="text-success text-decoration-none">{{ $detail_product->category->name_categories ?? 'Kategori' }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($detail_product->name_product, 30) }}</li>
      </ol>
    </nav>

    <div class="row g-4">
      
      <!-- Left & Middle Container -->
      <div class="col-lg-9">
        <div class="row g-4">
          <!-- 1. Left Column: Image Gallery -->
          <div class="col-md-5">
            <div style="position: sticky; top: 100px;">
              @php $firstImg = $detail_product->images->firstWhere('is_thumb', 1) ?? $detail_product->images->first(); @endphp
              <img src="{{ asset('assets/img/'.($firstImg->imageName ?? 'default.png')) }}" alt="{{ $detail_product->name_product }}" class="tkp-gallery-main" id="mainImage">
              
              <div class="d-flex" style="gap: 8px; overflow-x: auto; padding-bottom: 8px;">
                @foreach($detail_product->images as $img)
                  <img src="{{ asset('assets/img/'.$img->imageName) }}" alt="thumb" class="tkp-gallery-thumb {{ $loop->first ? 'active' : '' }}" onclick="changeMainImage(this, '{{ asset('assets/img/'.$img->imageName) }}')">
                @endforeach
              </div>
            </div>
          </div>

          <!-- 2. Middle Column: Product Info -->
          <div class="col-md-7 pe-lg-4">
        <h1 class="tkp-title tkp-text-main">{{ $detail_product->name_product }}</h1>
        
        <div class="d-flex align-items-center mb-3" style="font-size: 14px;">
          <span class="tkp-text-main">Terjual <strong style="font-weight: 600;">{{ $detail_product->sold_count ?? 0 }}</strong></span>
          <span class="mx-2" style="color: #E5E7E9;">•</span>
          <span class="material-symbols-outlined text-warning" style="font-size: 18px;">star</span>
          <span class="ms-1 tkp-text-main"><strong style="font-weight: 600;">{{ number_format($detail_product->averageRating() ?: 5, 1) }}</strong></span>
          <span class="ms-1 tkp-text-muted">({{ $detail_product->reviews->count() }} rating)</span>
        </div>

        <div class="tkp-price tkp-text-main">Rp{{ number_format($detail_product->price, 0, '.', '.') }}</div>

        <!-- Detail Tabs -->
        <div class="tkp-tabs">
          <div class="tkp-tab active">Detail Produk</div>
        </div>

        <div class="tkp-text-main" style="font-size: 14px; line-height: 1.6;">
          <div class="mb-3">
            <div>Kondisi: <strong class="tkp-text-green">Baru</strong></div>
            <div>Min. Beli: <strong>1 Buah</strong></div>
            <div>Kategori: <a href="{{ route('get.category', $detail_product->category_id) }}" class="tkp-text-green text-decoration-none fw-bold">{{ $detail_product->category->name_categories ?? '-' }}</a></div>
          </div>
          
          <div style="white-space: pre-wrap;">{{ $detail_product->description_product }}</div>
        </div>

        <!-- Reviews Section -->
        <div class="mt-5 pt-4" style="border-top: 4px solid #F3F4F5;">
          <h3 style="font-size: 18px; font-weight: 700; color: #31353B; margin-bottom: 20px;">Ulasan Pembeli</h3>
          @if($detail_product->reviews->count() > 0)
            @foreach($detail_product->reviews->take(5) as $review)
              <div class="mb-4">
                <div class="d-flex align-items-center mb-2">
                  <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white me-2" style="width: 32px; height: 32px; font-size: 14px;">
                    {{ strtoupper(substr($review->user->name ?? 'P', 0, 1)) }}
                  </div>
                  <div>
                    <div style="font-size: 14px; font-weight: 600; color: #31353B;">{{ $review->user->name ?? 'Pembeli' }}</div>
                    <div class="d-flex text-warning" style="font-size: 14px;">
                      @for($i = 1; $i <= 5; $i++)
                        <span class="material-symbols-outlined" style="font-size: 14px;">{{ $i <= $review->rating ? 'star' : 'star_border' }}</span>
                      @endfor
                    </div>
                  </div>
                </div>
                <div style="font-size: 14px; color: #31353B;">{{ $review->comment }}</div>
              </div>
            @endforeach
          @else
            <div class="text-center tkp-text-muted py-4">Belum ada ulasan untuk produk ini.</div>
          @endif
        </div>
      </div> <!-- End of col-md-7 -->
    </div> <!-- End of inner row -->

        <!-- Rekomendasi / Produk Lainnya -->
        <div class="mt-5 pt-4">
          <h3 style="font-size: 18px; font-weight: 700; color: #31353B; margin-bottom: 20px;">Rekomendasi untuk Anda</h3>
          <div class="row g-3">
            @foreach($other_products as $op)
            <div class="col-md-3 col-6">
              <a href="{{ route('detail', $op->id) }}" class="text-decoration-none">
                <div class="card h-100 border-0" style="box-shadow: 0 1px 6px 0 rgba(49,53,59,0.12); border-radius: 8px; overflow: hidden; transition: transform 0.2s;">
                  @php $opImg = $op->images->firstWhere('is_thumb', 1) ?? $op->images->first(); @endphp
                  <img src="{{ asset('assets/img/'.($opImg->imageName ?? 'default.png')) }}" class="card-img-top" alt="{{ $op->name_product }}" style="aspect-ratio: 1/1; object-fit: cover;">
                  <div class="card-body p-2">
                    <div style="font-size: 14px; color: #31353B; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 42px;">{{ $op->name_product }}</div>
                    <div class="mt-1" style="font-size: 16px; font-weight: 700; color: #31353B;">Rp{{ number_format($op->price, 0, '.', '.') }}</div>
                    <div class="d-flex align-items-center mt-1" style="font-size: 12px; color: #6D7588;">
                      <span class="material-symbols-outlined text-warning" style="font-size: 14px;">star</span>
                      <span class="ms-1">{{ number_format($op->averageRating() ?: 5, 1) }}</span>
                      <span class="mx-1">•</span>
                      <span>Terjual {{ $op->sold_count ?? 0 }}</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            @endforeach
          </div>
        </div>

      </div> <!-- End of col-lg-9 -->

      <!-- 3. Right Column: Action Box -->
      <div class="col-lg-3 col-md-12">
        <div class="tkp-floating-box">
          <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 16px;" class="tkp-text-main">Atur jumlah dan catatan</h3>
          
          <!-- Add to Cart Form -->
          <form action="{{ route('cart.add', $detail_product->id) }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $detail_product->id }}">
            
            <div class="d-flex align-items-center mb-3">
              <div class="tkp-qty-box me-3">
                <button type="button" class="tkp-qty-btn" id="btn-minus" onclick="updateQty(-1)">−</button>
                <input type="number" name="quantity" id="input-qty" value="1" min="1" max="{{ $detail_product->stock }}" class="tkp-qty-input" onchange="calculateSubtotal()" readonly>
                <button type="button" class="tkp-qty-btn" id="btn-plus" onclick="updateQty(1)">+</button>
              </div>
              <div style="font-size: 14px;">Stok: <strong class="tkp-text-main">{{ $detail_product->stock }}</strong></div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
              <div class="tkp-text-muted" style="font-size: 14px;">Subtotal</div>
              <div style="font-size: 18px; font-weight: 700;" class="tkp-text-main" id="subtotal-display">Rp{{ number_format($detail_product->price, 0, '.', '.') }}</div>
            </div>

            @if($detail_product->stock > 0)
              <div class="d-flex gap-2">
                <button type="submit" name="action" value="add_cart" class="btn w-100 tkp-btn-primary rounded-3 py-2">+ Keranjang</button>
              </div>
            @else
              <button type="button" class="btn w-100 btn-secondary rounded-3 py-2 fw-bold" disabled>Stok Habis</button>
            @endif
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@section('script')
<script>
const basePrice = {{ $detail_product->price }};
const maxStock = {{ $detail_product->stock }};

function formatRupiah(number) {
  return new Intl.NumberFormat('id-ID').format(number);
}

function updateQty(change) {
  let input = document.getElementById('input-qty');
  let currentVal = parseInt(input.value);
  let newVal = currentVal + change;
  
  if (newVal >= 1 && newVal <= maxStock) {
    input.value = newVal;
    calculateSubtotal();
  }
}

function calculateSubtotal() {
  let qty = parseInt(document.getElementById('input-qty').value);
  let subtotal = qty * basePrice;
  document.getElementById('subtotal-display').innerText = 'Rp' + formatRupiah(subtotal);
  
  // Update button states
  document.getElementById('btn-minus').style.color = qty > 1 ? '#00AA5B' : '#BFC9D9';
  document.getElementById('btn-plus').style.color = qty < maxStock ? '#00AA5B' : '#BFC9D9';
}

function changeMainImage(thumbElement, src) {
  document.getElementById('mainImage').src = src;
  document.querySelectorAll('.tkp-gallery-thumb').forEach(el => el.classList.remove('active'));
  thumbElement.classList.add('active');
}

// Initial calculation
calculateSubtotal();

// Dummy action for wishlist toggle
document.getElementById('btn-wishlist').addEventListener('click', function(e) {
  e.preventDefault();
  let icon = this.querySelector('.material-symbols-outlined');
  if (icon.innerText === 'favorite_border') {
    icon.innerText = 'favorite';
    icon.style.color = '#EF4444';
  } else {
    icon.innerText = 'favorite_border';
    icon.style.color = '';
  }
});
</script>
@endsection