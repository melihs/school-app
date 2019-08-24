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

Route::post('/login','Api\AuthController@login')->name('login');
Route::post('/register','Api\AuthController@register')->name('register');

Route::group(['middleware' => 'jwt'], function () {
    Route::get('users/{invite_code}/parents','UserController@getParent')->name('users.getParent');
    Route::get('users/me','UserController@me')->name('users.show');
    Route::apiResource('users','UserController')->except('show','create','edit');
});

