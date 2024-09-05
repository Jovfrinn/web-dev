<?php

namespace App\Http\Controllers;

use App\Models\Categories;

class CategoryController extends Controller
{

    public function show(string $id)
    {
        $categories = Categories::findOrFail($id);
        $products = $categories->products()->with('images')->get();
        // dd($products)

        $data['categories'] = $categories;
        $data['products'] = $products;

        return view('fronsite.category', $data);
    }
}