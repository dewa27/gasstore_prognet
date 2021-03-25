<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('user/index');
// });
// Route::get('/products', function () {
//     return view('user/product');
// });
//------------------START HALAMAN PUBLIK--------------------
Route::get('/', 'MainController@index');
Route::get('/products', 'MainController@products');
Route::get('/products/{product:id}/detail', 'MainController@product');
Route::get('/products/search', 'MainController@search');
Route::get('/cart', 'MainController@cart');
//------------------END HALAMAN PUBLIK--------------------


//------------------START HALAMAN ADMIN--------------------
//<<<<<----PRODUK : FINISHED---->>>>>
Route::get('/admin/products', 'ProductController@index');
Route::get('/admin/products/create', 'ProductController@create');
Route::post('/admin/products/store', 'ProductController@store');
Route::get('/admin/products/{product:id}/detail', 'ProductController@show');
Route::get('/admin/products/{product:id}/edit', 'ProductController@edit');
Route::post('/admin/products/{product:id}/update', 'ProductController@update');
Route::delete('/admin/products/{product:id}/delete', 'ProductController@delete');
Route::get('/admin/products/search', 'ProductController@search');
Route::get('/admin/products/trashed', 'ProductController@trash');
Route::delete('/admin/products/trashed/{id}/delete', 'ProductController@trashTheTrashed');
Route::get('/admin/products/trashed/{id}/restore', 'ProductController@restore');

//<<<<<----PRODUK KATEGORI: FINISHED---->>>>>
Route::get('/admin/categories', 'ProductCategoryController@index');
Route::get('/admin/categories/create', 'ProductCategoryController@create');
Route::post('/admin/categories/store', 'ProductCategoryController@store');
Route::get('/admin/categories/{product_category:id}/detail', 'ProductCategoryController@show');
Route::delete('/admin/categories/{product_category:id}/delete', 'ProductCategoryController@delete');

//<<<<<----KURIR: ON PROGRESS---->>>>>
Route::get('/admin/couriers', 'CourierController@index');
Route::get('/admin/couriers/create', 'CourierController@create');
Route::post('/admin/couriers/store', 'CourierController@store');
Route::get('/admin/couriers/{courier:id}/detail', 'CourierController@show');
Route::delete('/admin/couriers/{courier:id}/delete', 'CourierController@delete');

//<<<<<----DISKON: ON PROGRESS---->>>>>
Route::get('/admin/discounts', 'DiscountController@index');
Route::get('/admin/discounts/create', 'DiscountController@create');
Route::post('/admin/discounts/store', 'DiscountController@store');
Route::get('/admin/discounts/{Discount:id}/detail', 'DiscountController@show');
Route::delete('/admin/discounts/{Discount:id}/delete', 'DiscountController@delete');

//<<<<<----TRANSAKSI: ON PROGRESS---->>>>>
Route::get('/admin/transactions', 'TransactionController@index');

//<<<<<----TRANSAKSI: ON PROGRESS---->>>>>
Route::get('/admin/users', 'UserController@index');
//------------------END HALAMAN ADMIN--------------------