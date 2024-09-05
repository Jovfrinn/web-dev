<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->with('images')->get();
        $data['products'] = $products;

        return view('fronsite.home',$data);
    }

    public function search(Request $request){

        $query = $request->input('query');

        // Lakukan pencarian product berdasarkan nama
        $products = Product::where('name_product', 'LIKE', "%{$query}%")->get();
        $data['products'] = $products;
        $data['query'] = $query;
        return view('fronsite.search',$data);
    }
}
