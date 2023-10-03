<?php

use App\Http\Controllers\ProductsController;
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
    return view('welcome');
});

//商品一覧表示画面のルート
Route::get('/products', 'productController@index')->name('products.index');
//商品登録画面のルート
Route::get('/products/create', 'ProductController@create')->name('products.create');
//商品登録処理のルート
Route::post('/products', 'ProductController@store')->name('products.store');
//商品詳細表示画面のルート
Route::get('/products/{product}', 'ProductController@show')->name('products.show');
//商品編集画面のルート
Route::get('/products/{product}/edit', 'ProductController@edit')->name('products.edit');
//商品更新処理のルート
Route::put('/products/{product}', 'ProductController@update')->name('products.update');
//商品削除処理のルート
Route::delete('/products/{product}', 'ProductsController@destroy')->name('products.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/products', 'ProductController@index')->name('products.index');
    Route::get('/products/create', 'ProductController@create')->name('products.create');
    Route::post('/products', 'ProductController@store')->name('products.store');
    Route::get('/products/{product}', 'ProductController@show')->name('products.show');
    Route::get('/products/{product}/edit', 'ProductController@edit')->name('products.edit');
    Route::put('/products/{product}', 'ProductController@update')->name('products.update');
    Route::delete('/products/{product}', 'ProductController@destroy')->name('products.destroy');
});
