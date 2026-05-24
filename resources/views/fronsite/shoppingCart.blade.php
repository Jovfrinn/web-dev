@extends('fronsite.layouts.navbar')
@section('title', 'Keranjang Belanja — TrendStore')
@section('content')

<style>
/* Reset input number arrows */
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
input[type=number] {
  -moz-appearance: textfield;
}

/* Custom Checkbox */
.ts-checkbox {
  width: 20px;
  height: 20px;
  cursor: pointer;
  accent-color: #00AA5B;
}

/* Action Icons hover */
.ts-action-icon {
  color: #9FA6B0;
  transition: color 0.2s;
}
.ts-action-icon:hover {
  color: #00AA5B;
}
.ts-action-icon-danger:hover {
  color: #EF4444;
}
</style>

<div class="ts-section" style="background-color: #F3F4F5; min-height: 80vh; padding-top: 32px;">
  <div class="container">
    <h1 class="mb-4" style="font-size: 24px; font-weight: 800; color: #31353B;">Keranjang</h1>

    @if(isset($cartItems) && count($cartItems) > 0)
    <div class="row g-4">
      <div class="col-lg-8">
        
        <!-- Cart Group / Shop Header -->
        <div class="ts-cart-group" style="background: white; border-radius: 8px; padding: 24px; box-shadow: 0 1px 6px 0 rgba(49,53,59,0.12);">
          
          <!-- Select All & Shop Header -->
          <div class="d-flex align-items-center mb-3 pb-3" style="border-bottom: 4px solid #F3F4F5;">
            <input type="checkbox" class="ts-checkbox me-3" id="check-all" checked>
            <span style="font-size: 14px; color: #31353B;">Pilih Semua (<span id="total-items-header">{{ $cartItems->sum('quantity') }}</span>)</span>
          </div>

          <div class="d-flex align-items-center mb-3 mt-4">
            <input type="checkbox" class="ts-checkbox me-3 ts-shop-checkbox" checked>
            <span class="material-symbols-outlined text-success" style="font-size: 20px;">verified</span>
            <strong class="ms-2" style="font-size: 16px; color: #31353B;">TrendStore Official</strong>
          </div>

          @foreach($cartItems as $item)
          <div class="ts-cart-item-row d-flex mb-2 mt-4" style="gap: 16px;" data-price="{{ $item->product->price }}" data-subtotal="{{ $item->sub_total }}" data-qty="{{ $item->quantity }}">
            <!-- Checkbox -->
            <div class="ts-cart-item-checkbox pt-4 mt-1">
              <input type="checkbox" class="ts-checkbox ts-item-checkbox" checked>
            </div>
            
            <!-- Image -->
            <div class="ts-cart-item-img-wrap" style="width: 80px; height: 80px; flex-shrink: 0;">
              @foreach($item->product->images as $img)
                @if($img->is_thumb == 1)
                  <img src="{{ asset('assets/img/'.$img->imageName) }}" alt="{{ $item->product->name_product }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                @endif
              @endforeach
            </div>
            
            <!-- Details & Actions -->
            <div class="ts-cart-item-details d-flex flex-column flex-grow-1">
              <div class="d-flex justify-content-between">
                <!-- Product Info -->
                <div class="ts-cart-item-title-wrap" style="max-width: 65%;">
                  <a href="{{ route('detail', $item->product->id) }}" style="text-decoration: none; font-size: 16px; color: #31353B; display: block; margin-bottom: 6px; line-height: 1.4;">{{ $item->product->name_product }}</a>
                  <div style="font-size: 14px; color: #8D96AA;">Kategori: {{ $item->product->category->name_categories ?? '-' }}</div>
                </div>
                
                <!-- Price -->
                <div class="ts-cart-item-price-wrap text-end">
                  <div style="font-weight: 700; font-size: 16px; color: #31353B;">Rp {{ number_format($item->sub_total, 0, '.', '.') }}</div>
                  @if($item->product->stock <= 5 && $item->product->stock > 0)
                    <div style="font-size: 12px; color: #EF4444; margin-top: 4px;">Sisa {{ $item->product->stock }}</div>
                  @endif
                </div>
              </div>

              <!-- Bottom Actions (Delete, Qty) -->
              <div class="d-flex justify-content-end align-items-center mt-3 pt-2" style="gap: 24px;">
                <div class="d-flex align-items-center text-muted" style="gap: 20px;">
                  <form action="{{ route('cart.delete', $item->id) }}" method="POST" class="m-0 p-0 d-flex align-items-center">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-link p-0 m-0 text-decoration-none ts-action-icon ts-action-icon-danger" title="Hapus">
                      <span class="material-symbols-outlined" style="font-size: 24px;">delete</span>
                    </button>
                  </form>
                </div>
                
                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="ts-qty-form m-0">
                  @csrf @method('PUT')
                  <div class="ts-qty-control" style="display: flex; align-items: center; border: 1px solid #BFC9D9; border-radius: 6px; overflow: hidden; height: 32px;">
                    <button type="button" class="ts-qty-minus" style="width: 32px; height: 100%; border: none; background: white; color: {{ $item->quantity > 1 ? '#00AA5B' : '#BFC9D9' }}; font-weight: bold; font-size: 20px; cursor: pointer; display: flex; align-items: center; justify-content: center;">−</button>
                    
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="text-center" style="width: 44px; height: 100%; border: none; font-size: 14px; font-weight: 600; color: #31353B; outline: none;" id="qty-{{ $item->id }}" onchange="this.form.submit()">
                    
                    <button type="button" class="ts-qty-plus" style="width: 32px; height: 100%; border: none; background: white; color: {{ $item->quantity < $item->product->stock ? '#00AA5B' : '#BFC9D9' }}; font-weight: bold; font-size: 20px; cursor: pointer; display: flex; align-items: center; justify-content: center;">+</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          @if(!$loop->last)
            <hr style="border-color: #F3F4F5; border-width: 2px; margin: 24px 0;">
          @endif
          @endforeach
        </div>
      </div>

      <!-- Order Summary -->
      <div class="col-lg-4">
        <div class="ts-cart-summary" style="background: white; border-radius: 8px; padding: 16px 20px; box-shadow: 0 1px 6px 0 rgba(49,53,59,0.12); position: sticky; top: 100px;">
          <h3 class="mb-4" style="font-size: 16px; font-weight: 700; color: #31353B;">Ringkasan belanja</h3>
          
          <div class="d-flex justify-content-between mb-3" style="font-size: 14px; color: #31353B;">
            <span>Total Harga (<span id="summary-count">{{ $cartItems->sum('quantity') }}</span> barang)</span>
            <span id="summary-subtotal">Rp {{ number_format($cartItems->sum('sub_total'), 0, '.', '.') }}</span>
          </div>
          
          <hr style="border-color: #E5E7E9; margin: 16px 0;">

          <div class="d-flex justify-content-between mb-4 align-items-center">
            <strong style="font-size: 16px; color: #31353B;">Total Harga</strong>
            <strong style="font-size: 18px; color: #31353B;" id="summary-total">Rp {{ number_format($cartItems->sum('sub_total'), 0, '.', '.') }}</strong>
          </div>

          <form action="{{ route('post.checkout') }}" method="POST" id="checkout-form">
            @csrf
            <button type="submit" id="checkout-btn" class="w-100" style="background: #00AA5B; color: white; border: none; border-radius: 8px; padding: 12px; font-weight: 700; font-size: 16px; transition: background 0.2s;" onmouseover="this.style.background='#008F4C'" onmouseout="this.style.background='#00AA5B'">
              Beli (<span id="btn-count">{{ $cartItems->sum('quantity') }}</span>)
            </button>
          </form>
        </div>
      </div>
    </div>
    @else
    <div class="ts-empty-state text-center py-5" style="background: white; border-radius: 8px; box-shadow: 0 1px 6px 0 rgba(49,53,59,0.12);">
      <img src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/104edeb9.png" alt="Empty Cart" style="max-width: 250px; margin-bottom: 24px;">
      <h3 style="font-size: 20px; font-weight: 700; color: #31353B; margin-bottom: 8px;">Keranjangmu kosong nih</h3>
      <p style="color: #6D7588; margin-bottom: 24px;">Daripada dianggurin, mending isi dengan barang-barang impianmu. Yuk, cek sekarang!</p>
      <a href="{{ url('/') }}" class="ts-btn" style="background: #00AA5B; color: white; padding: 12px 48px; border-radius: 8px; font-weight: 700; text-decoration: none;">Belanja Sekarang</a>
    </div>
    @endif
  </div>
</div>
@endsection

@section('script')
<script>
// Qty control auto submit with modern UX
document.querySelectorAll('.ts-qty-minus').forEach(btn => {
  btn.addEventListener('click', function() {
    const input = this.nextElementSibling;
    if (parseInt(input.value) > 1) {
      input.value = parseInt(input.value) - 1;
      input.form.submit();
    }
  });
});
document.querySelectorAll('.ts-qty-plus').forEach(btn => {
  btn.addEventListener('click', function() {
    const input = this.previousElementSibling;
    const max = parseInt(input.getAttribute('max'));
    if (parseInt(input.value) < max) {
      input.value = parseInt(input.value) + 1;
      input.form.submit();
    }
  });
});
</script>
<script>
// Dynamic Checkbox Calculation
function formatRupiah(number) {
  return new Intl.NumberFormat('id-ID').format(number);
}

function updateCartSummary() {
  let totalQty = 0;
  let totalPrice = 0;
  let checkedBoxes = document.querySelectorAll('.ts-item-checkbox:checked');
  let allBoxes = document.querySelectorAll('.ts-item-checkbox');
  
  checkedBoxes.forEach(function(checkbox) {
    let row = checkbox.closest('.ts-cart-item-row');
    totalQty += parseInt(row.getAttribute('data-qty'));
    totalPrice += parseInt(row.getAttribute('data-subtotal'));
  });

  // Update DOM elements
  document.getElementById('summary-count').innerText = totalQty;
  document.getElementById('summary-subtotal').innerText = 'Rp ' + formatRupiah(totalPrice);
  document.getElementById('summary-total').innerText = 'Rp ' + formatRupiah(totalPrice);
  document.getElementById('btn-count').innerText = totalQty;
  document.getElementById('total-items-header').innerText = totalQty;

  // Sync Check All
  let isAllChecked = (allBoxes.length > 0 && allBoxes.length === checkedBoxes.length);
  document.getElementById('check-all').checked = isAllChecked;
  document.querySelectorAll('.ts-shop-checkbox').forEach(cb => cb.checked = isAllChecked);

  // Disable checkout btn if nothing checked
  let checkoutBtn = document.getElementById('checkout-btn');
  if (totalQty === 0) {
    checkoutBtn.disabled = true;
    checkoutBtn.style.background = '#BFC9D9';
  } else {
    checkoutBtn.disabled = false;
    checkoutBtn.style.background = '#00AA5B';
  }
}

// Event Listeners for Checkboxes
document.querySelectorAll('.ts-item-checkbox').forEach(function(checkbox) {
  checkbox.addEventListener('change', updateCartSummary);
});

document.getElementById('check-all').addEventListener('change', function() {
  let isChecked = this.checked;
  document.querySelectorAll('.ts-item-checkbox, .ts-shop-checkbox').forEach(function(cb) {
    cb.checked = isChecked;
  });
  updateCartSummary();
});

document.querySelectorAll('.ts-shop-checkbox').forEach(function(checkbox) {
  checkbox.addEventListener('change', function() {
    let isChecked = this.checked;
    document.querySelectorAll('.ts-item-checkbox').forEach(function(cb) {
      cb.checked = isChecked;
    });
    updateCartSummary();
  });
});

// Intercept checkout form for partial checkout warning
document.getElementById('checkout-form').addEventListener('submit', function(e) {
  let allBoxes = document.querySelectorAll('.ts-item-checkbox');
  let checkedBoxes = document.querySelectorAll('.ts-item-checkbox:checked');
  if (checkedBoxes.length < allBoxes.length) {
    e.preventDefault();
    alert('Maaf, fitur Checkout Sebagian (memilih produk tertentu) sedang dalam tahap pengembangan. Saat ini Anda harus membeli seluruh barang di keranjang. Silakan hapus barang yang tidak ingin dibeli menggunakan tombol tong sampah.');
    // Check all again
    document.getElementById('check-all').checked = true;
    document.getElementById('check-all').dispatchEvent(new Event('change'));
  }
});

// Initialize on load
updateCartSummary();
</script>
@endsection
