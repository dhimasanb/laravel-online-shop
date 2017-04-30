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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('categories', 'CategoriesController');
Route::resource('products', 'ProductsController');
Route::get('/catalogs', 'CatalogsController@index');
Route::post('cart', 'CartController@addProduct');
Route::get('cart', 'CartController@show');
Route::delete('cart/{product_id}', 'CartController@removeProduct');
Route::put('cart/{product_id}', 'CartController@changeQuantity');
Route::get('checkout/login', 'CheckoutController@login');
Route::post('checkout/login', 'CheckoutController@postLogin');
