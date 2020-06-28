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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ShopController@index');

// ログイン状態
Route::group(['middleware' => 'auth'], function() {
    Route::get('/mycart', 'ShopController@myCart');
    Route::post('/mycart', 'ShopController@addMyCart');//追記
    Route::post('/cartdelete', 'ShopController@deleteCart');//追記
});