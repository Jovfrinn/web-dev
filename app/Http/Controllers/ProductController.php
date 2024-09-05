<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->with('images')->get();
        $data['products'] = $products;

        return view('fronsite.home',$data);
    }

    public function addStock($id, $amount){
        $products = Product::findOrFail($id);
        $products->increaseStock($amount);
        
        return redirect()->back()->with('Success', 'Stock berhasil di tambahkan');
    }

    public function reduceStock($id, $amount)
    {
        try {
            $products = Product::findOrFail($id);
            $products->decreaseStock($amount);

            return redirect()->back()->with('success', 'Stok berhasil dikurangi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
