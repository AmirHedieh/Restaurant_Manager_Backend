<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('item', 'ItemController@store');
    Route::put('item/{id}', 'ItemController@update');
    Route::get('item', 'ItemController@index');
    Route::get('item/{id}', 'ItemController@show');
    Route::delete('item/{id}', 'ItemController@delete');

    Route::post('order', 'OrderController@store');
    Route::put('order/{id}', 'OrderController@update');
    Route::get('order', 'OrderController@index');
    Route::get('order/{id}', 'OrderController@show');
    Route::delete('order/{id}', 'OrderController@delete');

    Route::post('item/{id}/comments', '@CommentController@store');
    Route::get('item/{id}/comments', '@CommentController@index');
    Route::get('item/{id}/comments/{id}', '@CommentController@show');
});
