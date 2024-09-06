@extends('fronsite.layouts.navbar')
@section('content')
<div class="cart-container container">
    <h1 class="title-cart">Your Shopping Cart</h1>
    <table class="table-cart mx-auto">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>


            {{-- @foreach($cart as $data)
            <tr>
                <td>{{$data['name_product']}}</td>
                <td>{{$data['description_product']}}</td>
                <td>1</td>
                <td>{{number_format($data['price'],0,'.','.')}}</td> --}}


            @foreach($cartItems as $data)
            <tr>
                {{-- @dd($data->product->images) --}}
                @foreach ($data->product->images as $image)
                @if($image->is_thumb == 1)
                <td><img class="img-cart" src="{{asset('assets/img/'. $image->imageName)}}" alt=""></td>
                @endif
                @endforeach

                <td>{{$data->product->name_product}}</td>
                <td class="price-cart">Rp {{number_format($data->product->price,0,'.','')}}</td>


                <td>
                        <div class="quantity d-flex justify-content-center" tabindex="0">
                        <input type="number" class="quantity-input" name="quantity" value="{{$data->quantity}}" min="1" id="quantity" data-id="{{$data->id}}" data-id-product="{{$data->product->id}}">
                        </div>
                </td>
                <td>Rp {{$data->sub_total}}</td>
                <td>
                    <form action="{{route('cart.delete', $data->product->id)}}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="productId" value="{{ $data->product->id }}">
                        <button type="submit" class="btn button-delete-cart" data-product-id="{{ $data->product->id }}">
                            <span class="material-symbols-outlined ms-1">delete</span>
                        </button>
                    </form>
            </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <form action="{{route('post.checkout')}}" method="POST">
    <div class="total">
        <p><strong>Total Semua Produk: <span id="total">Rp {{$grand_total}}</span> </strong></p>
            @csrf
            <input type="hidden" name="user" value="{{Auth::user()->id}}">
            <input type="hidden" name="grand_total" value="{{$grand_total}}">

        </div>
        {{-- @endforeach --}}
        <div class="button-cart d-flex justify-content-between">
        <a class="btn" href="/">Kembali Berbelanja</a>
        <button type="submit" class="btn">Lanjut Pembayaran</button>
        </div>
    </form>

</div>


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

