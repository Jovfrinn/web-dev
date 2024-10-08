<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\CheckoutDetail;
use App\Models\Product;
use App\Models\shopping_cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        $checkouts = Checkout::where('user_id', $user_id)->get();
        $cartItems = shopping_cart::where('user_id', $user_id)->with(['product','product.images'])->get();
        $data['checkouts'] = $checkouts;
        $data['cartItems'] = $cartItems;

        return view('fronsite.checkout', $data);
    }
    public function store(Request $request)
    {
            $user_id = $request->input('user');
            $cartItems = shopping_cart::where('user_id', $user_id)->get();
            $checkouts = Checkout::where('user_id', $user_id)->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.show')->with('error', 'Keranjang kosong. Tambahkan item ke keranjang terlebih dahulu.');
            }
            $grandTotal = $request->input('grand_total');
    
            if($checkouts->isEmpty()){
            DB::transaction(function () use ($cartItems, $user_id, $grandTotal) {
                $checkout = Checkout::create([
                    'user_id' => $user_id,
                    'grand_total' => $grandTotal,
                ]);
            });
        }
            return redirect()->route('checkout.show')->with('success', 'Checkout berhasil!');
    }

    public function deleteCheckout($id)
    {
        $checkout = Checkout::findOrFail($id);

        $checkout->delete();

        return redirect()->route('cart.show')->with('success', 'Kembali Ke Halaman Shopping Csrt');
    }

    public function deleteCartChekout()
    {   
        $user_id = Auth::id();

        $checkouts = Checkout::all()->last();        
        $shopping_cart = shopping_cart::where('user_id', $user_id)->get();
        foreach( $shopping_cart as $item){
            $product = Product::findOrFail($item->product_id);
            if($product){
                $product->stock = $product->stock - $item->quantity;
                $product->sold_count = $item->quantity;
                $product->save();
            }
        }


        shopping_cart::where('user_id', $user_id)->delete();
        CheckoutDetail::where('checkout_id', $checkouts->id)->delete();
        $checkouts->delete();

        $cartItems = shopping_cart::where('user_id', Auth::id())->with(['product','product.images'])->orderBy('created_at', 'desc')->get();
        session()->put('cart', count($cartItems));


        return redirect()->route('index')->with('success', 'Transaksi Berhasil');

    }

  
}
