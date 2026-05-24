<?php
use App\Models\Categories;
use App\Models\Product;

if (!function_exists('getCategory')) {
    function getCategory()
    {
        $categories = Categories::orderBy('created_at', 'ASC')->get();

        return $categories;
    }
}

if (!function_exists('getProduct')) {
    function getProduct()
    {
        $products = Product::orderBy('created_at', 'ASC')->get();

        return $products;
    }
}


?>