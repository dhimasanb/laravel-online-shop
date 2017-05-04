<?php

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

/* Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('categories', 'CategoriesController');
Route::resource('products', 'ProductsController');
Route::get('/', 'CatalogsController@index');
Route::post('cart', 'CartController@addProduct');
Route::get('cart', 'CartController@show');
Route::delete('cart/{product_id}', 'CartController@removeProduct');
Route::put('cart/{product_id}', 'CartController@changeQuantity');
Route::get('checkout/login', 'CheckoutController@login');
Route::post('checkout/login', 'CheckoutController@postLogin');
Route::get('checkout/address', function() {
    return "Email customer " . session()->get('checkout.email');
});
Route::get('checkout/address', 'CheckoutController@address');
Route::post('checkout/address', 'CheckoutController@postAddress');
/*Route::get('checkout/payment', function() {
    return var_dump(session()->get('checkout'));
});*/
Route::get('checkout/payment', 'CheckoutController@payment');
Route::post('checkout/payment', 'CheckoutController@postPayment');
/* Route::get('checkout/success', function() {
    return session()->get('order');
});*/
Route::get('checkout/success', 'CheckoutController@success');

Route::resource('orders', 'OrdersController', ['only' => [
    'index', 'edit', 'update'
]]);

Route::get('/home/orders', 'HomeController@viewOrders');

Route::group(['middleware' => 'api'], function () {
    Route::get('address/regencies', 'AddressController@regencies');
});
