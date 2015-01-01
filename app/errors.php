<?php

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

App::error(function (Exception $exception, $code) {
    Log::error($exception);

    if (App::environment(['local', 'testing'])) {
        return null;
    }

    return Response::make(View::make('pages.500'), 500);
});

App::error(function (ModelNotFoundException $exception, $code) {
    Log::error($exception);

    if (App::environment(['local', 'testing'])) {
        return null;
    }

    return Response::make(View::make('pages.404'), 404);
});


App::error(function (MethodNotAllowedHttpException $exception, $code) {
    Log::error($exception);

    if (App::environment(['local', 'testing'])) {
        return null;
    }

    Return Response::make(View::make('pages.403'), 403);
});


App::error(function (Laracasts\Validation\FormValidationException $exception, $code) {
    return Redirect::back()->withInput()->withErrors($exception->getErrors());
});