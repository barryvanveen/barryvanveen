<?php

namespace Barryvanveen\Exceptions;

use Bugsnag;
use Exception;
use GoogleTagManager;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Input;
use Meta;
use Redirect;
use Response;
use Session;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use View;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
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
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $exception
     */
    public function report(Exception $exception)
    {
        if ($this->shouldReport($exception)) {
            Bugsnag::notifyException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof TokenMismatchException) {
            return $this->tokenMismatchResponse();
        } elseif ($exception instanceof InvalidLoginException) {
            return $this->invalidLoginResponse();
        } elseif ($exception instanceof HttpResponseException) {
            return $exception->getResponse();
        } elseif ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        } elseif ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

        if (config('app.debug') && !($exception instanceof ValidationException) && !($exception instanceof HttpResponseException)) {
            return $this->renderWhoopsResponse($exception);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->renderErrorPageResponse(404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->renderErrorPageResponse(403);
        }

        return $this->renderErrorPageResponse(500);
    }

    /**
     * @param Exception $exception
     *
     * @return \Illuminate\Http\Response
     */
    protected function renderWhoopsResponse(Exception $exception)
    {
        return $this->toIlluminateResponse($this->convertExceptionToResponse($exception), $exception);
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
     * @param \Illuminate\Auth\AuthenticationException $exception
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('admin.login'));
    }
}
