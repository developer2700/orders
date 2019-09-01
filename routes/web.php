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
    return view('orders.list');
});

Route::get('/users', function () {
    return view('users.list');
});

Route::get('/users/edit/{user}', function () {
    return view('users.edit');
});

Route::get('/users/create', function () {
    return view('users.edit');
});


Route::get('/orders', function () {
    return view('orders.list');
});

Route::get('/orders/create', function () {
    return view('orders.edit');
});

Route::get('/orders/edit/{order}', function () {
    return view('orders.edit');
});



Route::get('/products', function () {
    return view('products.list');
});

Route::get('/products/create', function () {
    return view('products.edit');
});

Route::get('/products/edit/{product}', function () {
    return view('products.edit');
});
