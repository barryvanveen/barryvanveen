<?php
namespace Barryvanveen\Exceptions;

use Bugsnag;
use Bugsnag\BugsnagLaravel\BugsnagExceptionHandler as ExceptionHandler;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Session\TokenMismatchException;
use Input;
use JavaScript;
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
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * Log exceptions to Bugsnag and write them to the log file.
     *
     * @param \Exception $e
     */
    public function report(Exception $e)
    {
        Bugsnag::setAppVersion(config('app.version'));

        parent::report($e);
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
            return $this->toIlluminateResponse($this->convertExceptionToResponse($e), $e);
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
            Meta::set('title', trans('meta.pagetitle-404') . ' - ' . trans('meta.pagetitle-default'));

            JavaScript::put(array(
                'errorcode' => 404
            ));

            return Response::make(View::make('templates.404'), 404);
        }

        // model not found
        if ($e instanceof ModelNotFoundException) {
            Meta::set('title', trans('meta.pagetitle-404') . ' - ' . trans('meta.pagetitle-default'));

            JavaScript::put(array(
                'errorcode' => 404
            ));

            return Response::make(View::make('templates.404'), 404);
        }

        // not authorized to see this route
        if ($e instanceof MethodNotAllowedHttpException) {
            Meta::set('title', trans('meta.pagetitle-403') . ' - ' . trans('meta.pagetitle-default'));

            JavaScript::put(array(
                'errorcode' => 403
            ));

            return Response::make(View::make('templates.403'), 403);
        }

        // general error
        Meta::set('title', trans('meta.pagetitle-500') . ' - ' . trans('meta.pagetitle-default'));

        JavaScript::put(array(
            'errorcode' => 500
        ));

        return Response::make(View::make('templates.500'), 500);
    }
}
