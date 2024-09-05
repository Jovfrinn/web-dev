<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DetailController extends Controller
{
    public function show(string $id)
    {
        $product = Product::with('images')->findOrFail($id);
        $data['detail_product'] = $product;
        return view('fronsite.detail',$data);
    }

}
