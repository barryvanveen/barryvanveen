<?php
namespace Barryvanveen\Logs;

use App;
use Barryvanveen\Mailers\ExceptionMailer;
use Config;
use Log;
use Redirect;
use Response;
use View;

class Logger
{
    /**
     * Handle an exeption (log, email) and redirect to view.
     *
     * @param $exception
     * @param $template
     * @param $responseCode
     *
     * @return Response
     */
    public static function logAndRedirectToView($exception, $template, $responseCode)
    {
        Log::error($exception);

        self::mailException($exception);

        self::returnIfDebuggingEnabled();

        return Response::make(View::make($template), $responseCode);
    }

    /**
     * Handle an exeption (log, email) and redirect back with errors.
     *
     * @param $exception
     * @param $input
     * @param $errors
     *
     * @return Redirect
     */
    public static function logAndRedirectBackWithErrors($exception, $input = null, $errors)
    {
        Log::info($exception);

        self::mailException($exception);

        self::returnIfDebuggingEnabled();

        return Redirect::back()->withInput($input)->withErrors($errors);
    }

    /**
     * Mail an exception to keep the webmaster informed.
     *
     * @param $exception
     */
    public static function mailException($exception)
    {
        if (!App::environment('local')) {
            /** @var ExceptionMailer $mailer */
            $mailer = App::make('Barryvanveen\Mailers\ExceptionMailer');
            $mailer->sendExceptionMail($exception);
        }
    }

    /**
     * Return nothing in case debugging is enabled.
     * This will display the Whoops error page with full debugging info.
     */
    public static function returnIfDebuggingEnabled()
    {
        if (Config::get('app.debug')) {
            return;
        }
    }
}
