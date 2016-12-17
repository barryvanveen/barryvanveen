<?php

namespace Barryvanveen\Exceptions;

use Meta;
use View;
use Input;
use Bugsnag;
use Session;
use Redirect;
use Response;
use Exception;
use GoogleTagManager;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e
     */
    public function report(Exception $e)
    {
        if ($this->shouldReport($e)) {
            Bugsnag::notifyException($e);
        }

        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $e
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function render($request, Exception $e)
    {
        $e = $this->prepareException($e);

        if ($e instanceof TokenMismatchException) {
            return $this->tokenMismatchResponse();
        } elseif ($e instanceof InvalidLoginException) {
            return $this->invalidLoginResponse();
        } elseif ($e instanceof HttpResponseException) {
            return $e->getResponse();
        } elseif ($e instanceof AuthenticationException) {
            return $this->unauthenticated($request, $e);
        } elseif ($e instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($e, $request);
        }

        if (config('app.debug') && ! ($e instanceof ValidationException) && ! ($e instanceof HttpResponseException)) {
            return $this->renderWhoopsResponse($e);
        }

        if ($e instanceof NotFoundHttpException) {
            return $this->renderErrorPageResponse(404);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->renderErrorPageResponse(403);
        }

        return $this->renderErrorPageResponse(500);
    }

    /**
     * @param Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    protected function renderWhoopsResponse(Exception $e)
    {
        return $this->toIlluminateResponse($this->convertExceptionToResponse($e), $e);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function tokenMismatchResponse()
    {
        Session::regenerateToken();

        $errors = [
            '_token' => [
                trans('validation.token-mismatch'),
            ],
        ];

        return Redirect::back()->withInput(Input::except('_token'))->withErrors($errors);
    }

    /**
     * Display.
     *
     * @param $status_code
     *
     * @return \Illuminate\Http\Response
     */
    protected function renderErrorPageResponse($status_code)
    {
        Meta::set('title', trans('meta.pagetitle-'.$status_code).' - '.trans('meta.pagetitle-default'));

        GoogleTagManager::set('errorcode', $status_code);

        return Response::make(View::make('errors.'.$status_code), $status_code);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invalidLoginResponse()
    {
        $errors = [
            'password' => [
                trans('validation.invalid-login'),
            ],
        ];

        return Redirect::back()->withInput(['email' => Input::get('email')])->withErrors($errors);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param \Illuminate\Http\Request                 $request
     * @param \Illuminate\Auth\AuthenticationException $e
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function unauthenticated($request, AuthenticationException $e)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('admin.login'));
    }
}
