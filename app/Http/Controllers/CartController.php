<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\shopping_cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = shopping_cart::where('user_id', Auth::id())->with(['product','product.images'])->orderBy('created_at', 'desc')->get();

        $grand_total = $cartItems->sum('sub_total');
        $data['cartItems'] = $cartItems;
        $data['grand_total'] = $grand_total;
        session()->put('cart', count($cartItems));
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
        $product = Product::findOrFail($request->product_id);
        // dd($product->id);

        $cartItem = shopping_cart::where('user_id', Auth::id())
                                ->where('product_id', $product->id)
                                ->first();



        if ($cartItem) {
            return redirect()->back()->with('failed', 'Product already exist in Cart');
        } else {
            shopping_cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
                'sub_total' => $product->price * 1,
            ]);
        }

        $cartItems = shopping_cart::where('user_id', Auth::id())->with(['product','product.images'])->orderBy('created_at', 'desc')->get();
        $cart_count = session()->get('cart', []);
        session()->put('cart', count($cartItems));

        return redirect()->back()->with('success', 'Product added to cart!');


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
        $product = Product::findOrFail($request->productId);

        $cartItem = shopping_cart::findOrFail($id);
        $cartItem->quantity = $request->input('quantity');
        $cartItem->sub_total = $cartItem->quantity * $product->price;
        $cartItem->save();

        return response()->json([
            'status' => 'quary_ok',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {

        $userId = Auth::id();
        $productId = $request->input('productId');

        // Hapus entri dari tabel cart
        shopping_cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();


        $cartItems = shopping_cart::where('user_id', Auth::id())->with(['product','product.images'])->orderBy('created_at', 'desc')->get();
            session()->put('cart', count($cartItems));

        return redirect()->back()->with('success', 'Delete Product success');

    }
}
