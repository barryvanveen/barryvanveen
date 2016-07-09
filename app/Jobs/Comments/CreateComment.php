<?php
namespace Barryvanveen\Jobs\Comments;

use Barryvanveen\Comments\Comment;
use Barryvanveen\Comments\CommentRepository;

class CreateComment
{
    public $blog_id;
    public $email;
    public $text;

    /**
     * @param int    $blog_id
     * @param string $email
     * @param string $text
     */
    public function __construct($blog_id, $email, $text)
    {
        $this->blog_id = $blog_id;
        $this->email   = $email;
        $this->text    = $text;
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

        $comment->blog_id = $this->blog_id;
        $comment->email   = $this->email;
        $comment->text    = $this->text;

        return $commentRepository->save($comment);
    }
}
