<?php namespace Barryvanveen\Mailers;

use Barryvanveen\Recipients\Recipient;
use Exception;

class ExceptionMailer extends Mailer
{
    /**
     * @param Exception $exception
     */
    public function sendExceptionMail(Exception $exception)
    {
        $recipient = new Recipient('barryvanveen@gmail.com', 'Barry van Veen');
        $subject   = '[barryvanveen.nl] '.get_class($exception);
        $view      = 'emails.exception';

        $this->send($recipient, $subject, $view, [
            'environment'       => \App::environment(),
            'exception'         => get_class($exception),
            'exception_code'    => $exception->getCode(),
            'exception_file'    => $exception->getFile(),
            'exception_line'    => $exception->getLine(),
            'exception_message' => $exception->getMessage(),
        ]);
    }
}
