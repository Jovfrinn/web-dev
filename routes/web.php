<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('fronsite.home');
});


Route::get('/detail/{id}', [
    'uses' => 'App\Http\Controllers\DetailController@show',
    'as' => 'detail'
]);

Route::post('/add-to-cart{id}',  [
    'uses' => 'App\Http\Controllers\CartController@addToCart',
    'as' => 'cart.add'
]);
Route::get('/shopping_cart',  [
    'uses' => 'App\Http\Controllers\CartController@index',
    'as' => 'cart.show'
]);
Route::delete('/shopping_cart/delete/{product_id}',  [
    'uses' => 'App\Http\Controllers\CartController@destroy',
    'as' => 'cart.delete'
]);
Route::get('/category/{id}', [
    'uses' => 'App\Http\Controllers\CategoryController@show',
    'as' => 'get.category'
] );
Route::get('/admin',  [
    'uses' => 'App\Http\Controllers\backsite\StockController@index',
    'as' => 'get.admin'
]);
Route::post('/product/{id}/add-stock', [
    'uses' => 'App\Http\Controllers\backsite\StockController@addStock',
    'as' => 'product.add.stock'
] );
Route::post('/product/{id}/decrase-stock', [
    'uses' => 'App\Http\Controllers\backsite\StockController@reduceStock',
    'as' => 'product.reduce.stock'
] );




Route::resource('/', ProductController::class);
