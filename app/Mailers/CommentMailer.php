<?php
namespace Barryvanveen\Mailers;

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Comments\Comment;
use Barryvanveen\Recipients\Recipient;

class CommentMailer extends Mailer
{
    /**
     * @param Blog $blog
     * @param Comment $comment
     */
    public function sendCommentMail(Blog $blog, Comment $comment)
    {
        $recipient = new Recipient(config('mail.to.address'), config('mail.to.name'));
        $subject   = trans('email.new-comment', ['url' => url('')]);
        $view      = 'emails.new-comment';

        $this->send($recipient, $subject, $view, [
            'environment' => \App::environment(),
            'comment'     => $comment,
            'url'         => route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]),
        ]);
    }
}
