<?php
namespace Barryvanveen\Jobs\Comments;

use Barryvanveen\Comments\CommentRepository;

class UpdateComment
{
    public $id;
    public $email;
    public $name;
    public $text;
    public $ip;

    /**
     * @param $id
     * @param $email
     * @param $name
     * @param $text
     * @param $ip
     */
    public function __construct($id, $email, $name, $text, $ip)
    {
        $this->id    = $id;
        $this->email = $email;
        $this->name  = $name;
        $this->text  = $text;
        $this->ip    = $ip;
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
        $comment->name  = $this->name;
        $comment->text  = $this->text;
        $comment->ip    = $this->ip;

        $commentRepository->save($comment);
    }
}
