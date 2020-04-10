<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});
Route::get('getProductBySubCate/{id}', 'Api\ProductController@getProductBySubCate')->name('getProductBySubCate');

Route::get('featuredProducts/', 'Api\ProductController@featuredProducts')->name('featuredProducts');


Route::post('/login', 'Api\AuthController@login')->name('login.api');
Route::post('/register', 'Api\AuthController@register')->name('register.api');
Route::get('/getAll', 'Api\CategoryController@getAll')->name('getAll');

Route::post('/sendMail', 'Api\ForgotController@sendMail')->name('sendMail');
Route::group(['prefix' => 'forgot', 'as' => 'forgot'], function () {
    Route::post('sendpassword', 'Api\ForgotController@sendMail')->name('sendpassword');
    Route::post('updatepassword', 'Api\ForgotController@UpdatePassword')->name('updatepassword');
});
Route::get('/allProduct', 'Api\ProductController@getAllProduct')->name('allProduct');
Route::get('getPage/', 'Api\QueryController@page')->name('getPage');
Route::get('coupon_details', 'Api\QueryController@coupon_details')->name('coupon_details');



Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'user', 'as' => 'user'], function () {
        Route::get('logOut/', 'Api\UserController@logOut')->name('logOut');
        Route::get('userInfo/', 'Api\UserController@userInfo')->name('userInfo');
        Route::post('changePassword/', 'Api\UserController@changePassword')->name('changePassword');
        Route::post('EditProfile/', 'Api\UserController@update')->name('EditProfile');
        Route::post('storeAddress/', 'Api\UserController@store')->name('storeAddress');
    });
    Route::group(['prefix' => 'category', 'as' => 'category'], function () {
        Route::get('getCategory/', 'Api\CategoryController@getCategory')->name('getCategory');
    });

    Route::group(['prefix' => 'query', 'as' => 'query'], function () {
        Route::post('store/', 'Api\QueryController@store')->name('store');
    });

    Route::group(['prefix' => 'payment', 'as' => 'payment'], function () {
        Route::post('paymentStore/', 'Api\OrderController@paymentStore')->name('paymentStore');
        Route::get('previousOrders/', 'Api\OrderController@GetOrdersById')->name('previousOrders');
    });
});
