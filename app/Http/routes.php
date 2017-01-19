<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


use Illuminate\Support\Facades\Event;

Route::get('/', 'HomeController@index');
Route::get('orders/new','OrderController@create');

/**
 * Trainer route part
 */
Route::group(['prefix' => 'trainer', 'namespace' => 'Trainer'], function(){

    Route::get('auth/login', 'Auth\AuthController@showLoginForm');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@logout');

    Route::get('home', 'HomeController@index');

});

/**
 * Admin route part
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){

    Route::get('login', 'Auth\AuthController@showLoginForm');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@logout');

    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');

    Route::get('home', 'HomeController@index');
    
    Route::get('orders', 'OrderController@index');
    Route::get('orders/show/{order_id}', 'OrderController@show');
    Route::post('orders/{order_id}/status/update', 'OrderController@statusUpdate');

    Route::get('products', 'ProductController@index');
    Route::get('products/create', 'ProductController@create');
    Route::post('products/save', 'ProductController@save');
    Route::post('products/delete/{product_id}', 'ProductController@delete');
    Route::get('products/edit/{product_id}', 'ProductController@edit');
    Route::post('products/update', 'ProductController@update');

    Route::get('products/{product_id}/images/new', 'ProductController@newImage');
    Route::post('products/{product_id}/images/upload', 'ProductController@uploadImage');
    Route::post('products/images/delete/{image_id}', 'ProductController@deleteImage');
    Route::post('products/{product_id}/images/set_thumbnail/{id}', 'ProductController@setThumbnail');

    Route::get('trainers', 'TrainerController@index');

});
