@extends('backsite.layouts.sidebar')

@section('backContent')
    <div class="section-editStock">
        <div class="title-editStock">
            Edit Stock
        </div>

        <div class="section-product">
            <div class="icon-editStock">
                <span class="material-symbols-outlined">
                    inventory_2
                </span>
            </div>
            <div class="product-card">
                <div class="img-stockProduct">
                    @foreach($products->images as $image)
                    @if($image->is_thumb == 1)
                    <img src="{{asset('assets/img/'.$image->imageName)}}" alt="">
                    @endif
                    @endforeach
                </div>
                <div class="name-stockProduct">{{$products->name_product}}</div>
                <div class="real-stock">Stock Tersisa : {{$products->stock}}</div>
                <div class="edit-stock">
                    <form action="{{route('product.edit.stock', $products->id)}}" method="POST">
                        @csrf
                        <div class="quantity mx-auto d-flex justify-content-center" tabindex="0">
                            <i class="fa-solid fa-minus icon-counter" id="decrease"></i>
                            <input type="number" name="quantityStock" value="{{$products->stock}}" min="1" id="qtyInput" />
                            <i class="fa-solid fa-plus icon-counter" id="increase"></i>
                        </div>
                        <button type="submit" class="btn btn-addStock">Ubah</button>
                    </form>
                </div>
             
            </div>
        </div>
    </div>
@endsection

@section('backScript')
<script>
const qtyInput = document.getElementById('qtyInput');
const decreaseBtn = document.getElementById('decrease');
const increaseBtn = document.getElementById('increase');

decreaseBtn.addEventListener('click', function() {
    let currentValue = parseInt(qtyInput.value);
    if (currentValue > 1) { 
        qtyInput.value = currentValue - 1;
    }
});

// Event listener untuk tombol plus
increaseBtn.addEventListener('click', function() {
    let currentValue = parseInt(qtyInput.value);
    qtyInput.value = currentValue + 1; 
});

</script>
@endsection
