<?php
namespace Barryvanveen\Jobs\Comments;

use Barryvanveen\Comments\Comment;
use Barryvanveen\Comments\CommentRepository;

class CreateComment
{
    public $blog_id;
    public $email;
    public $name;
    public $text;
    public $ip;
    public $fingerprint;

    /**
     * @param int    $blog_id
     * @param string $email
     * @param string $name
     * @param string $text
     * @param string $ip
     * @param string $fingerprint
     */
    public function __construct($blog_id, $email, $name, $text, $ip, $fingerprint)
    {
        $this->blog_id     = $blog_id;
        $this->email       = $email;
        $this->name        = $name;
        $this->text        = $text;
        $this->ip          = $ip;
        $this->fingerprint = $fingerprint;
    }

    /**
     * Handle a command.
     *
     * @param CommentRepository $commentRepository
     *
     * @return mixed
     */
    public function handle(CommentRepository $commentRepository)
    {
        $comment = new Comment();

        $comment->blog_id     = $this->blog_id;
        $comment->email       = $this->email;
        $comment->name        = $this->name;
        $comment->text        = $this->text;
        $comment->ip          = $this->ip;
        $comment->fingerprint = $this->fingerprint;
        $comment->online      = 1;

        return $commentRepository->save($comment);
    }
}
