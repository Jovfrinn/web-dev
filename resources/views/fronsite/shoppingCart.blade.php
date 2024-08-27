@extends('fronsite.layouts.navbar')
@section('content')
<div class="container">
    <h1>Your Shopping Cart</h1>
    <table>
        <thead>
            <tr>
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
                <td>{{$data['price']}}</td>
                <td>
                    <form action="{{ route('cart.delete', $data['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="productId" value="{{ $data['id'] }}">
                        <button type="submit" data-product-id="{{ $data['id'] }}">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </form>
            </td>
            </tr>
            @endforeach
          
            <!-- Add more products as needed -->
        </tbody>
    </table>
    <div class="total">
        <p><strong>Grand Total: {{$totalPrice}}</strong></p>
    </div>
    <a href="/" class="btn">Continue Shopping</a>
</div>
@endsection