@extends('fronsite.layouts.navbar')
@section('content')
<div class="container">
    <h1>Your Shopping Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>


            @foreach($cart as $data)
            <tr>
                <td>{{$data['name_product']}}</td>
                <td>{{$data['description_product']}}</td>
                <td>1</td>
                <td>{{number_format($data['price'],0,'.','.')}}</td>


            @foreach($cartItems as $data)
            <tr>
                {{-- @dd($data->product->images) --}}
                @foreach ($data->product->images as $image)
                @if($image->is_thumb == 1)
                <td><img class="img-cart" src="{{asset('assets/img/'. $image->imageName)}}" alt=""></td>
                @endif
                @endforeach

                <td>{{$data->product->name_product}}</td>
                <td id="price" class="price-cart">Rp {{number_format($data->product->price,0,'.','')}}</td>

                <td>
                        <input type="number" class="quantity-input" name="quantity" value="{{$data->quantity}}" min="1" id="quantity" data-id="{{$data->id}}" data-id-product="{{$data->product->id}}">
                </td>
                <td>Rp {{$data->sub_total}}</td>
                <td>
                    <form action="{{route('cart.delete', $data->product->id)}}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="productId" value="{{ $data->product->id }}">
                        <button type="submit" data-product-id="{{ $data->product->id }}">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </form>
            </td>

            <td>
                <form action="{{ route('checkout.process')}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-block mt-3">Proses Checkout</button>
                </form>
            </td>
            </tr>
            @endforeach

             <!-- Add more products as needed -->



            <!-- Add more products as needed -->

        </tbody>
    </table>
    <form action="{{route('post.checkout')}}" method="POST">
    <div class="total">
        <p><strong>Grand Total: <span id="total">Rp {{$grand_total}}</span> </strong></p>
            @csrf
            <input type="hidden" name="user" value="{{Auth::user()->id}}">
            <input type="hidden" name="user" value="{{Auth::user()->id}}">
            <input type="hidden" name="grand_total" value="{{$grand_total}}">

        </div>
        <button type="submit">Continue Shopping</button>
    </form>

</div>





@endsection
@endsection

@section('script')
<script>
    $(document).ready(function() {
    $('.quantity-input').on('change', function() {
        var cartItemId = $(this).data('id'); // Ambil ID cart item dari atribut data-id
        var productId = $(this).data('id-product');
        var newQuantity = $(this).val(); // Ambil nilai quantity baru

        $.ajax({
            url: '/cart/' + cartItemId, // URL untuk mengirim permintaan AJAX
            type: 'PUT', // Metode HTTP PUT
            data: {
                _token: '{{ csrf_token() }}', // Sertakan CSRF token
                quantity: newQuantity, // Data yang dikirim ke server
                productId,
            },
            success: function(response) {
                console.log(response); // Debug respons
                // Jika permintaan berhasil, update total price di halaman
                $('#total-price-' + cartItemId).text(response.total_price);
                window.location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText); //
                alert('Gagal mengupdate quantity!');
            }
        });
    });
});
</script>
@endsection
