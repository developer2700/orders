<?php

Route::group(['namespace' => 'Api'], function () {

    Route::match(['get', 'post'], '/users/search', 'UsersController@index');
    Route::match(['put', 'patch', 'post'], '/users/{user}', 'UsersController@update');
    Route::post('users', 'UsersController@store');
    Route::delete('/users/{user}', 'UsersController@destroy');
    Route::get('users/{user}', 'UsersController@show');


    Route::match(['get', 'post'], '/products/search', 'ProductsController@index');
    Route::match(['put', 'patch', 'post'], '/products/{product}', 'ProductsController@update');
    Route::post('products', 'ProductsController@store');
    Route::delete('/products/{product}', 'ProductsController@destroy');
    Route::get('products/{product}', 'ProductsController@show');


    Route::match(['get', 'post'], '/orders/search', 'OrdersController@index');
    Route::match(['put', 'patch', 'post'], '/orders/{order}', 'OrdersController@update');
    Route::post('orders', 'OrdersController@store');
    Route::delete('/orders/{order}', 'OrdersController@destroy');
    Route::get('orders/{order}', 'OrdersController@show');


});
