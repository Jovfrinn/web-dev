<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DetailController extends Controller
{
    public function show(string $id)
    {
        $product = Product::with('images')->findOrFail($id);
        $otherProducts = Product::with('images')->where('id', '!=', $id)->inRandomOrder()->limit(12)->get();
        
        $data['detail_product'] = $product;
        $data['other_products'] = $otherProducts;
        return view('fronsite.detail',$data);
    }

}
