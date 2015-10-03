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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);


/* Login routes */

Route::get('auth/login', ['as' => 'getLogin', 'uses' => 'LoginController@getLogin']);
Route::post('auth/login', ['as' => 'postLogin', 'uses' => 'LoginController@postLogin']);
Route::get('auth/logout', ['as' => 'getLogin', 'uses' => 'LoginController@getLogout']);


/* Admin routes */

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('dashboard', ['as' => 'adminDashboard', 'uses' => 'AdminController@index']);


        /* Blog post administration */

        Route::group(['prefix' => 'posts'], function () {

            Route::get('dashboard', ['as' => 'postsDashboard', 'uses' => 'BlogPostController@index']);

            Route::get('create_new', ['as' => 'postsCreateNew', 'uses' => 'BlogPostController@getCreate']);
            Route::post('create_new', ['as' => 'postsCreateNewSave', 'uses' => 'BlogPostController@postCreate']);
        });


        /* Blog category administration */

        Route::group(['prefix' => 'categories'], function () {
            Route::get('dashboard', ['as' => 'categoriesDashboard', 'uses' => 'BlogCategoryController@index']);
        });

    });
});
