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

Route::post('/login','AuthController@login')->name('login');
Route::post('/register','AuthController@register')->name('register');

Route::group(['middleware' => 'jwt'], function () {
    Route::get('users/me','UserController@show')->name('users.show');
    Route::apiResource('users','UserController')->except('show','create','edit','destroy');
});

