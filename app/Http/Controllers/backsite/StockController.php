<?php

namespace App\Http\Controllers\backsite;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->with('images')->get();
        $data['products'] = $products;

        return view('backsite.stock',$data);
    }

    public function editStock($id, Request $request)
    {
        $products = Product::findOrFail($id);
        $stockBaru = $request->input('quantityStock');
        $products->stock = $stockBaru;
        $products->save();

        return redirect()->back()->with('success', 'Stok berhasil ditambah.');
    }

    public function show(string $id)
    {
        $products = Product::with('images')->findOrFail($id);
        $data['products'] = $products;

        return view('backsite.editStock', $data);
    }
}
