<?php
use App\Models\Categories;
use App\Models\Product;

function getCategory()
{
    $categories = Categories::orderBy('created_at', 'ASC')->get();

    return $categories;
}

function getProduct()
{
    $products = Product::orderBy('created_at', 'ASC')->get();

    return $products;
}


?>