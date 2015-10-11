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
    Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);

});


/* Admin routes */


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', ['as' => 'adminDashboard', 'uses' => 'AdminController@index']);

    /* Blog post administration */

    Route::group(['prefix' => 'posts'], function () {
        Route::get('dashboard', ['as' => 'postsDashboard', 'uses' => 'BlogController@indexAdmin']);
        Route::get('create_new', ['as' => 'getCreateBlogPost', 'uses' => 'BlogController@getCreate']);
        Route::post('create_new', ['as' => 'postCreateBlogPost', 'uses' => 'BlogController@postCreate']);
        Route::get('update/{id}', ['as' => 'getUpdateBlogPost', 'uses' => 'BlogController@getUpdate'])
            ->where('id', '[0-9]+');
        Route::post('update/{id}', ['as' => 'postUpdateBlogPost', 'uses' => 'BlogController@postUpdate'])
            ->where('id', '[0-9]+');
    });

    /* Blog category administration */

    Route::group(['prefix' => 'categories'], function () {
        Route::get('dashboard', ['as' => 'categoriesDashboard', 'uses' => 'BlogController@indexAdmin']);
    });

    /* Blog authors administration */

    Route::group(['prefix' => 'authors'], function () {
        Route::get('dashboard', ['as' => 'authorsDashboard', 'uses' => 'AuthorController@index']);
    });
});


/* Blog routes */

Route::group(['prefix' => 'blog'], function () {
    Route::get('/', ['as' => 'blog', 'uses' => 'BlogController@indexBlog']);
    Route::get('/{id}-{title}', ['as' => 'blogPost', 'uses' => 'BlogController@getBlogPost'])
        ->where('id', '[0-9]+')
        ->where('title', '[0-9, a-z, A-Z, \-]+');

    Route::post('comment', ['as' => 'postComment', 'uses' => 'BlogController@postComment']);
});


/* Static pages routes */

Route::get('contact', ['as' => 'contact', 'uses' => 'BlogController@indexBlog']);

