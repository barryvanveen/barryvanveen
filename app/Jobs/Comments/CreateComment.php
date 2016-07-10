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

    /**
     * @param int    $blog_id
     * @param string $email
     * @param string $name
     * @param string $text
     */
    public function __construct($blog_id, $email, $name, $text)
    {
        $this->blog_id = $blog_id;
        $this->email   = $email;
        $this->name    = $name;
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
        $comment->name    = $this->name;
        $comment->text    = $this->text;

        return $commentRepository->save($comment);
    }
}
