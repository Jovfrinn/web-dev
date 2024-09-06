@extends('fronsite.layouts.navbar')
@section('content')
    <div class="section-checkout container">
        <div class="row mx-auto">
            <div class="col-list-products col-md-6">
                <div class="section-list-products">
                    <table class="table-checkout" border="" colspan="0" rowspan="1">
                        <thead>
                            <tr>
                                <th colspan="5"><span class="material-symbols-outlined">
                                        store
                                    </span>Teaching Factory (2 Product)</th>
                            </tr>
                            <tr>
                                <th>Gambar</th>
                                <th>Produk</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    @foreach ($item->product->images as $image)
                                        @if ($image->is_thumb == 1)
                                            <td><img src="{{ asset('assets/img/' . $image->imageName) }}"
                                                    style="width: 120px"></td>
                                        @endif
                                    @endforeach
                                    <td>{{ $item->product->name_product }}</td>
                                    <td>{{ $item->product->price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->sub_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-price-checkout col-md-6">
                <div class="section-price-checkout">
                    <div class="total-price">Total Harga Pesanan <span>Rp {{ $checkouts->last()->grand_total }}</span></div>
                    <hr class="horizontal">
                    <div class="grand-total">Total Pembayaran <span>Rp {{ $checkouts->last()->grand_total }}</span></div>
                    <button id="pay-button" class="btn button-pay">Pay</button>
                    <a href="{{ route('delete.checkout', $checkouts->last()->id) }}"
                      class="btn btn-backCart">Kembali Ke Shopping Carts</a>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="checkout-container">
        <div class="row">
        <header class="col-md-6 header-checkout">
            <h1 class="text-checkout">Checkout</h1>
        </header>
        <main class="main-checkout">
            <section class="col-md-6 cart-summary">
                <table> 
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                        <tr>
                            @foreach ($item->product->images as $image)
                            @if ($image->is_thumb == 1)
                            <td><img src="{{asset('assets/img/'. $image->imageName)}}" style="width: 200px"></td>
                            @endif
                            @endforeach
                            <td>{{$item->product->name_product}}</td>
                            <td>{{$item->product->price}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->sub_total}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="cart-total">
                    <p>Grand Total : Rp {{$checkouts->last()->grand_total}}</p>
                </div>
                <button id="pay-button" style="background-color: black; color: white; width: 4rem">Pay</button>
                <a href="{{route('delete.checkout',$checkouts->last()->id)}}" style="background-color: black; color: white; width: 4rem">Kembali Ke Shopping Carts</a>

            </section>
        </main>
    </div>
    </div> --}}
@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script>
        $(document).ready(function() {
            $('#pay-button').click(function() {
                $.ajax({
                    url: '/create-snap-token', // Endpoint untuk mendapatkan token
                    method: 'GET', // Metode HTTP yang digunakan
                    success: function(data) {
                        if (data.token) {
                            snap.pay(data.token, {
                                onSuccess: function(result) {
                                    console.log('Payment success:', result);
                                    window.location.href =
                                        '{{ route('delete.checkoutCart') }}';
                                },
                                onPending: function(result) {
                                    console.log('Payment pending:', result);
                                    // Handle pending action here
                                },
                                onError: function(result) {
                                    console.log('Payment error:', result);
                                    // Handle error action here
                                }
                            });
                        } else {
                            console.error('Token not found in response');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Ajax error:', status, error);
                    }
                });
            });
        });
    </script>
@endsection
