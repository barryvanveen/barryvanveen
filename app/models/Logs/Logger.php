<?php namespace Barryvanveen\Logs;

use App;
use Barryvanveen\Mailers\ExceptionMailer;
use Config;
use Log;
use Response;
use View;

class Logger
{
    /**
     * Handle an exeption (logging, email, response).
     *
     * @param $exception
     * @param $template
     * @param $responseCode
     *
     * @return \Illuminate\Http\Response|void
     */
    public static function log($exception, $template, $responseCode)
    {
        Log::error($exception);

        if (!App::environment('local')) {
            /** @var ExceptionMailer $mailer */
            $mailer = App::make('Barryvanveen\Mailers\ExceptionMailer');
            $mailer->sendExceptionMail($exception);
        }

        if (Config::get('app.debug')) {
            return;
        }

        return Response::make(View::make($template), $responseCode);
    }
}
