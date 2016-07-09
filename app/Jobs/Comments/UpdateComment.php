<?php
namespace Barryvanveen\Jobs\Comments;

use Barryvanveen\Comments\CommentRepository;

class UpdateComment
{
    public $id;
    public $email;
    public $text;

    /**
     * @param $id
     * @param $email
     * @param $text
     */
    public function __construct($id, $email, $text)
    {
        $this->id    = $id;
        $this->email = $email;
        $this->text  = $text;
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
        $comment = $commentRepository->findById($this->id);

        $comment->email = $this->email;
        $comment->text  = $this->text;

        $commentRepository->save($comment);
    }
}
