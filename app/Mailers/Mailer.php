<?php
namespace Barryvanveen\Mailers;

use Barryvanveen\Recipients\Recipient;
use Illuminate\Mail\Mailer as Mail;

class Mailer
{
    /** @var Mail */
    protected $mail;

    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Send an mail to the given recipient.
     *
     * @param Recipient $to      The entity that receives the email
     * @param string    $subject Subject of your mail
     * @param string    $view    The view to render (the body of your mail)
     * @param array     $data    Data to assign to the view
     */
    public function send(Recipient $to, $subject, $view, $data = [])
    {
        // make sure the recipient is assigned to the email template
        $data['mailable'] = $to;
        $data['subject']  = $subject;

        $this->mail->send($view, $data, function ($message) use ($to, $subject) {

            /* @var \Illuminate\Mail\Message $message */

            $message->subject($subject);

            $message->to($to->email, $to->name);
        });
    }
}
