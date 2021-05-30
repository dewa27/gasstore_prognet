<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');
// Route::get('/login', 'MainController@login')->name('login');
// Route::get('/register', 'MainController@login')->name('register');
//------------------START HALAMAN PUBLIK--------------------
Route::get('/', 'MainController@index')->name('home');
Route::get('/products', 'MainController@products');
Route::get('/products/{product:id}/detail', 'MainController@product');
Route::get('/products/search', 'MainController@search');
// Route::get('/products/search', 'MainController@search');
// Route::get('/cart', 'MainController@cart')->middleware(['auth', 'verified']);
// Route::get('/login', 'MainController@login');
// Route::get('/register', 'MainController@register');
Route::post('/product/review', 'MainController@user_send_review');
//------------------START HALAMAN PUBLIK--------------------

//------------------START HALAMAN USER--------------------
// Route::get('/user/profile', 'User');

//------------------START HALAMAN USER--------------------

// ------------------START HALAMAN ADMIN--------------------
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
Route::post('/admin/product/review/response', 'ReviewController@send_response');

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
Route::get('/admin/discounts/{discount:id}/detail', 'DiscountController@show');
Route::delete('/admin/discounts/{discount:id}/delete', 'DiscountController@delete');

//<<<<<----TRANSAKSI: ON PROGRESS---->>>>>
Route::get('/admin/transactions', 'TransactionController@index');
Route::get('/admin/transactions/{transaction:id}/detail', 'TransactionController@show');
Route::post('/admin/transaction/update-status', 'TransactionController@updateStatus');

//<<<<<----TRANSAKSI: ON PROGRESS---->>>>>
Route::get('/admin/users', 'UserController@index');
//------------------END HALAMAN ADMIN--------------------
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/cart', 'MainController@cart');
    Route::get('/edit/profile', 'MainController@user_profile');
    Route::post('/edit/profile', 'MainController@post_user_profile');
    Route::get('/pembelian', 'MainController@pembelian');
    Route::get('/cart/checkout', 'MainController@checkout');
    Route::post('/product/checkout', 'MainController@instant_checkout');
    Route::post('/cart/checkout/get-city', 'MainController@getCity');
    Route::post('/cart/checkout/get-ongkir', 'MainController@getOngkir');
    Route::post('/add-to-cart', 'MainController@addToCart');
    Route::post('/cart/update', 'MainController@updateCart');
    Route::delete('/cart/{cart:id}/delete', 'MainController@deleteCart');
    Route::post('/cart/checkout', 'MainController@postCheckout');
    Route::get('/transaksi/{transaction:id}/detail', 'MainController@detail_transaksi');
    Route::post('/transaksi/upload-bukti', 'MainController@post_verif_pembayaran');
    Route::post('/product/checkout/send', 'MainController@product_post_checkout');
    Route::post('/transaksi/{transaction:id}/update-status', 'MainController@update_status_transaksi');
    Route::post('/notifikasi/baca', 'MainController@baca_notif');
});

Route::post('/cart/update', 'MainController@updateCart');
Route::prefix('admin')->group(function () {
    // Dashboard route
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    // Login routes
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    // Logout routenyah
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Register routes
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');

    // Password reset routes
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');

    Route::post('/notifikasi/baca', 'AdminController@baca_notif');
    //<<<<<----PRODUK : FINISHED---->>>>>
    // Route::get('/products', 'ProductController@index');
    // Route::get('/products/create', 'ProductController@create');
    // Route::post('/products/store', 'ProductController@store');
    // Route::get('/products/{product:id}/detail', 'ProductController@show');
    // Route::get('/products/{product:id}/edit', 'ProductController@edit');
    // Route::post('/products/{product:id}/update', 'ProductController@update');
    // Route::delete('/products/{product:id}/delete', 'ProductController@delete');
    // Route::get('/products/search', 'ProductController@search');
    // Route::get('/products/trashed', 'ProductController@trash');
    // Route::delete('/products/trashed/{id}/delete', 'ProductController@trashTheTrashed');
    // Route::get('/products/trashed/{id}/restore', 'ProductController@restore');
    // Route::post('/product/review/response', 'ReviewController@send_response');

    // //<<<<<----PRODUK KATEGORI: FINISHED---->>>>>
    // Route::get('/admin/categories', 'ProductCategoryController@index');
    // Route::get('/admin/categories/create', 'ProductCategoryController@create');
    // Route::post('/admin/categories/store', 'ProductCategoryController@store');
    // Route::get('/admin/categories/{product_category:id}/detail', 'ProductCategoryController@show');
    // Route::delete('/admin/categories/{product_category:id}/delete', 'ProductCategoryController@delete');

    // //<<<<<----KURIR: ON PROGRESS---->>>>>
    // Route::get('/admin/couriers', 'CourierController@index');
    // Route::get('/admin/couriers/create', 'CourierController@create');
    // Route::post('/admin/couriers/store', 'CourierController@store');
    // Route::get('/admin/couriers/{courier:id}/detail', 'CourierController@show');
    // Route::delete('/admin/couriers/{courier:id}/delete', 'CourierController@delete');

    // //<<<<<----DISKON: ON PROGRESS---->>>>>
    // Route::get('/admin/discounts', 'DiscountController@index');
    // Route::get('/admin/discounts/create', 'DiscountController@create');
    // Route::post('/admin/discounts/store', 'DiscountController@store');
    // Route::get('/admin/discounts/{discount:id}/detail', 'DiscountController@show');
    // Route::delete('/admin/discounts/{discount:id}/delete', 'DiscountController@delete');

    // //<<<<<----TRANSAKSI: ON PROGRESS---->>>>>
    // Route::get('/admin/transactions', 'TransactionController@index');
    // Route::get('/admin/transactions/{transaction:id}/detail', 'TransactionController@show');
    // Route::post('/admin/transaction/update-status', 'TransactionController@updateStatus');
});
