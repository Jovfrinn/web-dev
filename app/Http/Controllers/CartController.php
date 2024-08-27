<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalPrice = 0;
        foreach ($cart as $item) {
            // Hitung total harga item dan tambahkan ke total harga
            $totalPrice += $item['price'] * $item['quantity'];
        }
        // dd($totalPrice);
        $data['totalPrice'] = $totalPrice;
        $data['cart'] = $cart;
        return view('fronsite.shoppingCart', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function addToCart(Request $request){
        // $cart = session()->flush();
        $cart = session()->get('cart', []);
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);
        if (isset($cart[$productId])) {
            return redirect()->back()->with('anda memasukkan product');
        } else {
            $cart[$productId] = [
                'quantity' => 1,
                'id' => $product->id,
                'name_product' => $product->name_product,
                'description_product' => $product->description_product,
                'price' => $product->price,
                'category_id' => $product->category_id,
            ];

        }

        session()->put('cart', $cart);
        session()->put('cart_count', array_sum(array_column($cart, 'quantity')));

        return redirect()->back()->with('Success', 'Product berhasil di tambahkan');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$productId)
    {
    $cart = session()->get('cart', []);

    if (isset($cart[$productId])) {
        unset($cart[$productId]);

        session()->put('cart', $cart);

        $cartCount = array_sum(array_column($cart, 'quantity'));
        session()->put('cart_count', $cartCount);

        return redirect()->back()->with('Berhasil menghapus product');
    }

    return response()->json([
        'success' => false,
        'message' => 'Product not found in cart.'
    ]);
    }
}
