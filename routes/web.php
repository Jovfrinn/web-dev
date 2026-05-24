<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\backsite\DashboardController;
use App\Http\Controllers\backsite\ProductController as BacksiteProductController;
use App\Http\Controllers\backsite\StockController;
use App\Http\Controllers\backsite\OrderController as BacksiteOrderController;
use App\Http\Controllers\backsite\CategoryController as BacksiteCategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — TrendStore
|--------------------------------------------------------------------------
*/

// ===================== PUBLIC ROUTES =====================

Route::get('/', function () {
    $products = \App\Models\Product::with('images')->latest()->take(10)->get();
    // Simulate sold_count by random or just use latest if no column exists
    $productTerlaris = clone $products; // Since we don't have sold_count column
    $productTerjangkau = \App\Models\Product::with('images')->orderBy('price', 'asc')->take(10)->get();
    return view('fronsite.home', compact('products', 'productTerlaris', 'productTerjangkau'));
});

// Redirect welcome page to home
Route::get('/welcome', function () {
    return redirect('/');
});

// Product Detail
Route::get('/detail/{id}', [DetailController::class, 'show'])->name('detail');

// Category Filter
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('get.category');

// Search
Route::get('/search-product', [ProductController::class, 'search'])->name('search.product');

// ===================== AUTH ROUTES =====================
Auth::routes();

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ===================== AUTHENTICATED USER ROUTES =====================
Route::middleware('auth')->group(function () {

    // Cart
    Route::get('/shopping_cart', [CartController::class, 'index'])->name('cart.show');
    Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/shopping_cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');

    // Checkout
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('post.checkout');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.show');
    Route::get('/delete-cart-checkout', [CheckoutController::class, 'deleteCartChekout'])->name('delete.checkoutCart');
    Route::get('/delete-checkout/{id}', [CheckoutController::class, 'deleteCheckout'])->name('delete.checkout');

    // Payment
    Route::get('/create-snap-token', [PaymentController::class, 'createSnapToken'])->name('snap.token');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    // Order History
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// ===================== ADMIN ROUTES (Admin + Super Admin) =====================
Route::middleware(['auth', 'checkRole'])->prefix('backsite')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/', function () { return redirect()->route('admin.dashboard'); });

    // Products
    Route::get('/product', [BacksiteProductController::class, 'index'])->name('get.product.backsite');
    Route::get('/product/add', function () {
        return view('backsite.add-product');
    })->name('add.product.backsite');
    Route::post('/product', [BacksiteProductController::class, 'store'])->name('post.product.backsite');
    Route::get('/product/edit/{id}', [BacksiteProductController::class, 'edit'])->name('edit.product.backsite');
    Route::put('/product/update/{id}', [BacksiteProductController::class, 'update'])->name('put.product.backsite');
    Route::delete('/product/delete/{id}', [BacksiteProductController::class, 'destroy'])->name('delete.product.backsite');

    // Stock
    Route::get('/stock', [StockController::class, 'index'])->name('get.stock');
    Route::get('/stock/{id}', [StockController::class, 'show'])->name('show.stock');
    Route::post('/product/edit/stock/{id}', [StockController::class, 'editStock'])->name('product.edit.stock');

    // Orders (Admin)
    Route::get('/orders', [BacksiteOrderController::class, 'index'])->name('admin.orders');
    Route::get('/orders/{id}', [BacksiteOrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{id}/status', [BacksiteOrderController::class, 'updateStatus'])->name('admin.orders.status');

    // Categories (Admin)
    Route::get('/categories', [BacksiteCategoryController::class, 'index'])->name('admin.categories');
    Route::post('/categories', [BacksiteCategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/categories/{id}', [BacksiteCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [BacksiteCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Users (Super Admin)
    Route::get('/users', [App\Http\Controllers\backsite\UserController::class, 'index'])->name('admin.users');
    Route::put('/users/{id}/role', [App\Http\Controllers\backsite\UserController::class, 'updateRole'])->name('admin.users.updateRole');
});

// Legacy admin redirect
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});
