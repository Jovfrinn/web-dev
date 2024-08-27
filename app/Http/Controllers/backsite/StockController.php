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

        return view('backsite.home',$data);
    }

    public function addStock($id, Request $request)
    {
        $products = Product::findOrFail($id);
        $amount = $request->input('amount');
        $products->increaseStock($amount);

        return redirect()->back()->with('success', 'Stok berhasil ditambah.');
    }

    public function reduceStock($id, Request $request)
    {
        try {
            $products = Product::findOrFail($id);
            $amount = $request->input('amount');
            $products->decreaseStock($amount);

            return redirect()->back()->with('success', 'Stok berhasil dikurangi.');
        }   catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

   
    public function create()
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
