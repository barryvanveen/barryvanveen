<?php
namespace Barryvanveen\Exceptions;

use App;
use Barryvanveen\Mailers\ExceptionMailer;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Input;
use Log;
use Meta;
use Redirect;
use Response;
use Session;
use Symfony\Component\Debug\ExceptionHandler as SymfonyDisplayer;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use View;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
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
        $context = [
            'referer' => \URL::previous(),
            'url'     => \URL::current(),
            'ip'      => \Request::ip(),
        ];

        Log::error($e, $context);

        if (!config('app.debug')) {
            /** @var ExceptionMailer $mailer */
            $mailer = App::make('Barryvanveen\Mailers\ExceptionMailer');
            $mailer->sendExceptionMail($e, $context);
        }
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // render exception if debugging is enabled
        if (config('app.debug')) {
            return $this->toIlluminateResponse((new SymfonyDisplayer(config('app.debug')))->createResponse($e), $e);
        }

        // wrong csrf token
        if ($e instanceof TokenMismatchException) {
            Session::regenerateToken();

            $errors = [
                '_token' => [
                    trans('validation.token-mismatch'),
                ],
            ];

            return Redirect::back()->withInput(Input::except('_token'))->withErrors($errors);
        }

        // wrong login credentions
        if ($e instanceof InvalidLoginException) {
            sleep(3);

            $errors = [
                'password' => [
                    trans('validation.invalid-login'),
                ],
            ];

            return Redirect::back()->withInput(['email' => Input::get('email')])->withErrors($errors);
        }

        // route not found
        if ($e instanceof NotFoundHttpException) {
            Meta::title(trans('meta.pagetitle-404'));

            return Response::make(View::make('templates.404'), 404);
        }

        // model not found
        if ($e instanceof ModelNotFoundException) {
            Meta::title(trans('meta.pagetitle-404'));

            return Response::make(View::make('templates.404'), 404);
        }

        // not authorized to see this route
        if ($e instanceof MethodNotAllowedHttpException) {
            Meta::title(trans('meta.pagetitle-403'));

            return Response::make(View::make('templates.403'), 403);
        }

        // general error
        Meta::title(trans('meta.pagetitle-500'));

        return Response::make(View::make('templates.500'), 500);
    }
}
