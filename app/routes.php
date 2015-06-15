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
 * General routes.
 */
Route::get('', [
    'as'   => 'home',
    'uses' => 'BlogController@index',
]);

    Route::get('blog/{id}-{slug}', [
        'as'   => 'blog-item',
        'uses' => 'BlogController@show',
    ]);

    Route::get('rss', [
        'as'   => 'blog-rss',
        'uses' => 'BlogController@rss',
    ]);

Route::get('over-mij', [
    'as'   => 'over-mij',
    'uses' => 'PagesController@overMij',
]);

    Route::get('over-mij/boeken-die-ik-heb-gelezen', [
        'as'   => 'boeken',
        'uses' => 'PagesController@boeken',
    ]);

Route::get('luckytv-rss', [
    'as'   => 'luckytv-rss',
    'uses' => 'PagesController@luckytv',
]);

Route::get('images/{filename}', [
    'as'   => 'images',
    'uses' => 'ImagesController@show',
]);

/*
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {

    Route::get('inloggen', [
        'as'   => 'admin.login',
        'uses' => 'AdminLoginController@index',
    ]);

    Route::post('inloggen', [
        'before' => 'csrf',
        'as'     => 'admin.login',
        'uses'   => 'AdminLoginController@store',
    ]);

    Route::get('uitloggen', [
        'as'   => 'admin.logout',
        'uses' => 'AdminLoginController@destroy',
    ]);

    /*
     * Admin routes that require authorization
     */
    Route::group(['before' => 'auth'], function () {

        Route::get('/', [
            'as'   => 'admin.dashboard',
            'uses' => 'AdminDashboardController@index',
        ]);

        Route::get('blog', [
            'as'   => 'admin.blog',
            'uses' => 'AdminBlogController@index',
        ]);

            Route::get('blog/new', [
                'as'   => 'admin.blog-new',
                'uses' => 'AdminBlogController@create',
            ]);

            Route::post('blog/new', [
                'before' => 'csrf',
                'as'     => 'admin.blog-new',
                'uses'   => 'AdminBlogController@store',
            ]);

            Route::get('blog/{blogId}/edit', [
                'as'   => 'admin.blog-edit',
                'uses' => 'AdminBlogController@edit',
            ]);

            Route::patch('blog/{blogId}', [
                'before' => 'csrf',
                'as'     => 'admin.blog-update',
                'uses'   => 'AdminBlogController@update',
            ]);

        Route::get('pages', [
            'as'   => 'admin.page',
            'uses' => 'AdminPageController@index',
        ]);

            Route::get('pages/new', [
                'as'   => 'admin.page-new',
                'uses' => 'AdminPageController@create',
            ]);

            Route::post('pages/new', [
                'before' => 'csrf',
                'as'     => 'admin.page-new',
                'uses'   => 'AdminPageController@store',
            ]);

            Route::get('pages/{pageId}/edit', [
                'as'   => 'admin.page-edit',
                'uses' => 'AdminPageController@edit',
            ]);

            Route::patch('pages/{pageId}', [
                'before' => 'csrf',
                'as'     => 'admin.page-update',
                'uses'   => 'AdminPageController@update',
            ]);

        Route::post('markdown-to-html', [
            'before' => 'post-ajax-json',
            'as'     => 'admin.markdown-to-html',
            'uses'   => 'MarkdownController@parse',
        ]);

        Route::get('logs', [
            'as'   => 'admin.logs',
            'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index',
        ]);

    });

});
