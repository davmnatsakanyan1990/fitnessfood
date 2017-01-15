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


Route::get('/', 'HomeController@index');

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

    Route::post('products/{product_id}/images/create', 'ProductImageController@addImage');
    Route::get('products/{product_id}/images', 'ProductImageController@index');

    Route::get('products', 'ProductController@index');

});
