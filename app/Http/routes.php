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

Route::get('/', ['as' => 'home', 'uses' => 'homeController@index']);


Route::get('auth/login', ['as' => 'getLogin', 'uses' => 'loginController@getLogin']);
Route::post('auth/login', ['as' => 'postLogin', 'uses' => 'loginController@postLogin']);
Route::get('auth/logout', ['as' => 'getLogin', 'uses' => 'loginController@logout']);


Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('dashboard', ['as' => 'adminDashboard', 'uses' => 'adminController@index']);
    });
});
