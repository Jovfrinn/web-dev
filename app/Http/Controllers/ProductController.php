<?php

namespace App\Http\Controllers;

use App\Models\ImagesProduct;
use App\Models\Product;
use Database\Seeders\ImagesProductsSeeder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->with('images')->get();
        $data['products'] = $products;

        return view('fronsite.home',$data);
    }

    /**
     * Show the form for creating a new resource.
     */

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

    public function search(request $request){

        $query = $request->input('query');

        // Lakukan pencarian product berdasarkan nama
        $products = Product::where('name_product', 'LIKE', "%{$query}%")->get();
        $data['products'] = $products;
        $data['query'] = $query;
        return view('fronsite.search',$data);
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
