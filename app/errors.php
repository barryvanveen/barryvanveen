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

use Barryvanveen\Exceptions\InvalidLoginException;
use Barryvanveen\Logs\Logger;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Session\TokenMismatchException;
use Laracasts\Validation\FormValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

App::error(function (Exception $exception, $code) {
    return Logger::logAndRedirectToView($exception, 'templates.500', 500);
});

App::error(function (NotFoundHttpException $exception, $code) {
    return Logger::logAndRedirectToView($exception, 'templates.404', 404);
});

App::error(function (ModelNotFoundException $exception, $code) {
    return Logger::logAndRedirectToView($exception, 'templates.404', 404);
});

App::error(function (MethodNotAllowedHttpException $exception, $code) {
    return Logger::logAndRedirectToView($exception, 'templates.403', 403);
});

App::error(function (TokenMismatchException $exception, $code) {
    Session::regenerateToken();

    $errors = [
        '_token' => [
            trans('general.validation-token-mismatch'),
        ],
    ];

    return Logger::logAndRedirectBackWithErrors($exception, Input::except('_token'), $errors);
});

App::error(function (InvalidLoginException $exception, $code) {
    sleep(3);

    $errors = [
        'password' => [
            trans('general.invalid-login'),
        ],
    ];

    return Logger::logAndRedirectBackWithErrors($exception, null, $errors);
});

App::error(function (FormValidationException $exception, $code) {
    return Redirect::back()->withInput()->withErrors($exception->getErrors());
});
