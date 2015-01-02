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

Route::get('/', [
    'as'   => 'home',
    'uses' => 'PagesController@home'
]);

Route::get('/blog', [
    'as'   => 'blog',
    'uses' => 'BlogController@index'
]);

Route::get('/blog/{blog}', [
    'as'   => 'blog-item',
    'uses' => 'BlogController@show'
]);

Route::get('/elements', [
    'as'   => 'elements',
    'uses' => 'PagesController@elements'
]);
