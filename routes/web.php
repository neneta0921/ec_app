<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});



//Route::get('login/twitter', 'Auth\LoginController@redirectToTwitterProvider');
//Route::get('login/twitter/callback', 'Auth\LoginController@handleTwitterProviderCallback');

// Auth Twitter
Route::get('auth/twitter', 'Auth\AuthController@TwitterRedirect');
Route::get('auth/twitter/callback', 'Auth\AuthController@TwitterCallback');
Route::get('auth/twitter/logout', 'Auth\AuthController@getLogout');

// Auth Google
Route::get('auth/google', 'Auth\AuthController@GoogleRedirect');
Route::get('auth/google/callback', 'Auth\AuthController@GoogleCallback');
Route::get('auth/google/logout', 'Auth\AuthController@getLogout');

// Auth Facebook
Route::get('auth/facebook', 'Auth\AuthController@FacebookRedirect');
Route::get('auth/facebook/callback', 'Auth\AuthController@FacebookCallback');
Route::get('auth/facebook/logout', 'Auth\AuthController@getLogout');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ShopController@index');

// ログイン状態
Route::group(['middleware' => 'auth'], function() {
    Route::get('/mycart', 'ShopController@myCart');
    Route::post('/mycart', 'ShopController@addMyCart');
    Route::post('/cartdelete', 'ShopController@deleteCart');
    Route::post('/checkout', 'ShopController@checkout'); //追記
});

Auth::routes();