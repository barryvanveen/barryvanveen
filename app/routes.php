<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * General routes
 */
Route::get('', [
    'as'   => 'home',
    'uses' => 'PagesController@home'
]);

Route::get('/blog', [
    'as'   => 'blog',
    'uses' => 'BlogController@index'
]);

    Route::get('blog/{blog}', [
        'as'   => 'blog-item',
        'uses' => 'BlogController@show'
    ]);

/*Route::get('/projecten', [
    'as'   => 'projects',
    'uses' => 'ProjectsController@index'
]);

    Route::get('projecten/{project}', [
        'as'   => 'project-item',
        'uses' => 'ProjectsController@show'
    ]);*/

Route::get('over-mij', [
    'as'   => 'over-mij',
    'uses' => 'PagesController@overMij'
]);

/*Route::get('elements', [
    'as'   => 'elements',
    'uses' => 'PagesController@elements'
]);*/

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', function () {
        echo 'login page for admin section';
        exit;
    });

    /**
     * Admin routes that require authorization
     */
    Route::group(['before' => 'auth'], function () {

        Route::get('/', function () {
            echo 'admin dashboard';
            exit;
        });

        Route::get('/blog', function () {
            echo 'admin dashboard';
            exit;
        });

        Route::get('/pages', function () {
            echo 'pages dashboard';
            exit;
        });

    });

});
