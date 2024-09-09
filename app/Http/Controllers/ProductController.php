<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->with('images')->get();
        $productTerjangkau = Product::orderBy('price', 'asc')->with('images')->take(16)->get();
        $productTerlaris = Product::orderBy('sold_count', 'desc')->with('images')->take(16)->get();
        $data['products'] = $products;
        $data['productTerjangkau'] = $productTerjangkau;
        $data['productTerlaris'] = $productTerlaris;
        // $user = Auth::user()->name;
        // dd($user);

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
