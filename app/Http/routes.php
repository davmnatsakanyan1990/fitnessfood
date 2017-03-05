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


use App\Models\PromoCode;
use App\Models\Setting;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
Route::get('test1', function (){
//    unlink(public_path('mydir\card_data.zip'));
    $files = glob(public_path('card_exports/*'));
    Zipper::make('mydir/card_data.zip')->add($files)->close();


    return response()->download(public_path('mydir/card_data.zip'));

});
Route::get('/{locale?}', 'HomeController@index');
Route::post('orders/new/{locale}','OrderController@create');

/**
 * Trainer route part
 */
Route::group(['prefix' => 'trainer', 'namespace' => 'Trainer'], function(){

    Route::get('login/{locale}', 'Auth\AuthController@showLoginForm');
    Route::post('login/{locale}', 'Auth\AuthController@login');
    Route::get('logout/{locale}', 'Auth\AuthController@logout');

    Route::post('password/email/{locale}', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');
    Route::get('password/reset/{locale}/{token?}', 'Auth\PasswordController@getReset');

    Route::get('register/{locale}', 'Auth\AuthController@getRegister');
    Route::post('register/{locale}', 'Auth\AuthController@postRegister');

    Route::get('profile/{locale}', 'ProfileController@index');

    Route::get('settings/{locale}', 'SettingsController@index');
    Route::post('settings/update', 'SettingsController@update');

    Route::post('payments/new/{locale}', 'PaymentsController@create');

    Route::get('payments/{locale}', 'PaymentsController@index');

    Route::post('card_order/create', 'ProfileController@newCardOrder');

});

/**
 * Admin route part
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){

    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@logout');

    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');

    Route::get('home', 'HomeController@index');
    
    Route::get('orders', 'OrderController@index');
    Route::get('orders/show/{order_id}', 'OrderController@show');
    Route::post('orders/{order_id}/status/update', 'OrderController@statusUpdate');
    Route::get('order/seen/{id}', 'OrderController@orderSeen');

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
    Route::get('trainers/show/{id}', 'TrainerController@show');
    Route::post('trainers/delete/{id}', 'TrainerController@delete');
    Route::post('trainers/update/{id}', 'TrainerController@update');
    Route::get('trainers/approve/{id}', 'TrainerController@approve');
    Route::get('trainer/payments/seen/{trainer_id}', 'TrainerController@paymentsSeen');
    Route::get('trainers/seen/{id}', 'TrainerController@seen');
    Route::get('trainers/payments/{id}/{count}', 'TrainerController@morePayments');

    Route::get('payments', 'PaymentController@index');
    Route::post('payments/update', 'PaymentController@update');
    Route::post('payments/new', 'PaymentController@create');
    Route::post('payments/delete/{id}', 'PaymentController@delete');

    Route::get('settings', 'SettingsController@index');
    Route::post('settings/update', 'SettingsController@update');

    Route::get('gyms', 'GymController@index');
    Route::post('gyms/create', 'GymController@save');
    Route::get('gyms/get/{id}', 'GymController@getGym');
    Route::post('gyms/update/{id}', 'GymController@update');
    Route::post('gyms/delete/{id}', 'GymController@delete');

    Route::get('categories', 'CategoryController@index');
    Route::post('categories/new', 'CategoryController@create');
    Route::post('categories/update', 'CategoryController@update');
    Route::post('categories/delete/{id}', 'CategoryController@delete');
    Route::get('categories/get/{id}', 'CategoryController@getCategory');

    Route::get('pages/{title}', 'PagesController@edit');
    Route::post('pages/update/{id}', 'PagesController@update');

    Route::get('promo/all', 'PromoCodeController@index');
//    Route::post('promo/create', 'PromoCodeController@create');
//    Route::get('promo/get/{id}', 'PromoCodeController@getPromo');
//    Route::post('promo/edit', 'PromoCodeController@edit');
//    Route::post('promo/delete/{id}', 'PromoCodeController@delete');

    Route::get('promo_card/orders', 'CardOrderController@index');
    Route::get('promo_card/orders/seen', 'CardOrderController@ordersSeen');
    Route::get('promo_card/{id}', 'PromoCodeController@getCodeData');
    Route::post('card_data/export', 'CardOrderController@cardDataExport');

});

Route::get('about/{locale}', function($locale){
    App::setLocale($locale);
    $page = \App\Models\Page::where('title', 'about us')->first();
    $page->content = json_decode($page->content)->$locale;
    
    return view('about', compact('page'));
});
Route::get('basket/{locale}', 'BasketController@index');
Route::get('contact/{locale}', 'ContactUsController@index');
Route::post('contact/send/{locale}', 'ContactUsController@send');

// Ajax call
Route::post('basket/products/{locale}', 'BasketController@products');

// Ajax call
Route::get('products/get/{id}/{locale}', 'HomeController@getProduct');

// Ajax call
Route::get('trainers/search/{locale}', 'BasketController@searchTrainer');

// Ajax call
Route::get('promo/search/{locale}', 'BasketController@searchPromoCode');



