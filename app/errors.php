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
use Illuminate\Session\TokenMismatchException;
use Laracasts\Validation\FormValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

App::error(function (Exception $exception, $code) {
    Log::error($exception);

    if (Config::get('app.debug')) {
        return;
    }

    return Response::make(View::make('templates.500'), 500);
});

App::error(function (NotFoundHttpException $exception, $code) {
    Log::error($exception);

    if (Config::get('app.debug')) {
        return;
    }

    return Response::make(View::make('templates.404'), 404);
});

App::error(function (ModelNotFoundException $exception, $code) {
    Log::error($exception);

    if (Config::get('app.debug')) {
        return;
    }

    return Response::make(View::make('templates.404'), 404);
});

App::error(function (MethodNotAllowedHttpException $exception, $code) {
    Log::error($exception);

    if (Config::get('app.debug')) {
        return;
    }

    return Response::make(View::make('templates.403'), 403);
});

App::error(function (TokenMismatchException $exception, $code) {
    Log::error($exception);

    $errors = [
        '_token' => [
            trans('general.validation-token-mismatch'),
        ],
    ];

    Session::regenerateToken();

    return Redirect::back()->withInput(Input::except('_token'))->withErrors($errors);
});

App::error(function (FormValidationException $exception, $code) {
    return Redirect::back()->withInput()->withErrors($exception->getErrors());
});
