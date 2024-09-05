<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/admin', function () {
    return view('backsite.dashboard');
});

Auth::routes();

Route::middleware('auth')->group(function(){

    Route::get('/backsite/stock',  [
        'uses' => 'App\Http\Controllers\backsite\StockController@index',
        'as' => 'get.stock'
    ]);
    Route::get('/backsite/stock/{id}',  [
        'uses' => 'App\Http\Controllers\backsite\StockController@show',
        'as' => 'show.stock'
    ]);
    Route::post('/product/edit/{id}', [
        'uses' => 'App\Http\Controllers\backsite\StockController@editStock',
        'as' => 'product.edit.stock'
    ] );


    // product backsite
    Route::get('/backsite/product', [
        'uses' => 'App\Http\Controllers\backsite\ProductController@index',
        'as' => 'get.product.backsite'
    ] );
    Route::get('/backsite/product/add', function(){
        return view('backsite.add-product');
    });
    Route::post('/backsite/product', [
        'uses' => 'App\Http\Controllers\backsite\ProductController@store',
        'as' => 'post.product.backsite'
    ]);

    Route::get('/backsite/product/edit/{id}',  [
        'uses' => 'App\Http\Controllers\backsite\ProductController@edit',
        'as' => 'edit.product.backsite'
    ]);

    Route::put('/backsite/product/update/{id}', [
        'uses' => 'App\Http\Controllers\backsite\ProductController@update',
        'as' => 'put.product.backsite'
    ] );
    Route::delete('/backsite/product/delete/{id}', [
        'uses' => 'App\Http\Controllers\backsite\ProductController@destroy',
        'as' => 'delete.product.backsite'
    ] );

        // Shopping Cart
    Route::get('/shopping_cart',  [
            'uses' => 'App\Http\Controllers\CartController@index',
            'as' => 'cart.show'
        ]);
    Route::post('/add-to-cart{id}',  [
            'uses' => 'App\Http\Controllers\CartController@addToCart',
            'as' => 'cart.add'
        ]);
    Route::delete('/shopping_cart/delete/{id}',  [
            'uses' => 'App\Http\Controllers\CartController@destroy',
            'as' => 'cart.delete'
        ]);
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/logout',[
            'uses' => 'App\Http\Controllers\Auth\LoginController@logout',
                'as' => 'logout'
            ]);

    //  Checkout
    Route::post('/checkout',[
    'uses' => 'App\Http\Controllers\CheckoutController@store',
    'as' => 'post.checkout'
    ]);
    Route::get('/checkout',[
        'uses' => 'App\Http\Controllers\CheckoutController@index',
            'as' => 'checkout.show'
        ]);

        Route::get('/create-snap-token', [PaymentController::class, 'createSnapToken'])->name('snap.token');

        Route::get('/delete-cart-checkout',[
                'uses' => 'App\Http\Controllers\CheckoutController@deleteCartChekout',
                    'as' => 'delete.checkoutCart'
                ]);
        Route::get('/delete-checkout/{id}',[
                'uses' => 'App\Http\Controllers\CheckoutController@deleteCheckout',
                'as' => 'delete.checkout'
                ]);
});
Route::resource('/', ProductController::class);

Route::get('/detail/{id}', [
    'uses' => 'App\Http\Controllers\DetailController@show',
    'as' => 'detail'
]);
Route::get('/category/{id}', [
    'uses' => 'App\Http\Controllers\CategoryController@show',
    'as' => 'get.category'
] );

Route::get('/search-product', [
    'uses' => 'App\Http\Controllers\ProductController@search',
    'as' => 'search.product'
] );

Route::resource('/', ProductController::class);

