<?php

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
    return view('backsite.home');
});
Route::get('/category-makanan-snack', function () {
    return view('fronsite.halaman-makanan.makanan-snack');
})->name('category-snack');

Route::get('/category-makanan-kalengan', function () {
    return view('fronsite.halaman-makanan.makanan-kalengan');
})->name('category-kalengan');

Route::get('/category-makanan-biskuit', function () {
    return view('fronsite.halaman-makanan.makanan-roti-biskuit');
})->name('category-biskuit');

Route::get('/category-makanan-instan', function () {
    return view('fronsite.halaman-makanan.makanan-instan');
})->name('category-instan');

Route::get('/category-makanan-manis', function () {
    return view('fronsite.halaman-makanan.makanan-manis');
})->name('category-manis');



Route::get('/category-minuman-air-mineral', function () {
    return view('fronsite.halaman-minuman.minuman-air-mineral');
})->name('category-air-mineral');

Route::get('/category-minuman-botol', function () {
    return view('fronsite.halaman-minuman.minuman-botol');
})->name('category-botol');

Route::get('/category-minuman-jus', function () {
    return view('fronsite.halaman-minuman.minuman-jus');
})->name('category-jus');

Route::get('/category-minuman-kopi', function () {
    return view('fronsite.halaman-minuman.minuman-kopi');
})->name('category-kopi');

Route::get('/category-minuman-ringan', function () {
    return view('fronsite.halaman-minuman.minuman-ringan');
})->name('category-minuman-ringan');

Route::get('/category-minuman-sirup', function () {
    return view('fronsite.halaman-minuman.minuman-sirup');
})->name('category-sirup');

Route::get('/category-minuman-susu', function () {
    return view('fronsite.halaman-minuman.minuman-susu');
})->name('category-susu');

Route::get('/category-minuman-teh', function () {
    return view('fronsite.halaman-minuman.minuman-teh');
})->name('category-teh');



Route::get('/detail', [
    'uses' => 'App\Http\Controllers\DetailController@index',
    'as' => 'detail'
]);
