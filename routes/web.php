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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/show-cart', 'ProductsController@showCart');
Route::get('/show-products', 'ProductsController@showProducts');

Route::post('/process-cart', 'ProductsController@processCartProducts');
Route::post('/remove-cart', 'ProductsController@removeToCart');
Route::post('/add-quantity', 'ProductsController@addQuantityProduct');