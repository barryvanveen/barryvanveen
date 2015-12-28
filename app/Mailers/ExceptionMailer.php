<?php
namespace Barryvanveen\Mailers;

use Barryvanveen\Recipients\Recipient;
use Exception;

class ExceptionMailer extends Mailer
{
    /**
     * @param Exception $exception
     * @param array     $context
     */
    public function sendExceptionMail(Exception $exception, $context)
    {
        $url = str_replace(['http://', 'https://'], '', url());

        $recipient = new Recipient(env('MAIL_EXCEPTION_TO_ADDRESS'), env('MAIL_EXCEPTION_TO_NAME'));
        $subject   = '['.$url.'] '.get_class($exception);
        $view      = 'emails.exception';

        $this->send($recipient, $subject, $view, [
            'environment'       => \App::environment(),
            'exception'         => get_class($exception),
            'exception_code'    => $exception->getCode(),
            'exception_file'    => $exception->getFile(),
            'exception_line'    => $exception->getLine(),
            'exception_message' => $exception->getMessage(),
            'context'           => $context,
        ]);
    }
}
