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

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', ['as' => 'getLogin', 'uses' => 'LoginController@getLogin']);
    Route::post('login', ['as' => 'postLogin', 'uses' => 'LoginController@postLogin']);
    Route::get('logout', ['as' => 'getLogin', 'uses' => 'LoginController@getLogout']);
});


/* Admin routes */


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', ['as' => 'adminDashboard', 'uses' => 'AdminController@index']);


    /* Blog post administration */

    Route::group(['prefix' => 'posts'], function () {

        Route::get('dashboard', ['as' => 'postsDashboard', 'uses' => 'BlogController@indexAdmin']);

        Route::get('create_new', ['as' => 'postsCreateNew', 'uses' => 'BlogController@getCreate']);
        Route::post('create_new', ['as' => 'postsCreateNewSave', 'uses' => 'BlogController@postCreate']);
    });


    /* Blog category administration */

    Route::group(['prefix' => 'categories'], function () {
        Route::get('dashboard', ['as' => 'categoriesDashboard', 'uses' => 'BlogController@indexAdmin']);
    });

});


/* Blog routes */

Route::group(['prefix' => 'blog'], function () {
    Route::get('/', ['as' => 'blog', 'uses' => 'BlogController@indexBlog']);
});

