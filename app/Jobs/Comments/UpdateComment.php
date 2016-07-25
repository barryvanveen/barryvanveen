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
    public $fingerprint;

    /**
     * @param $id
     * @param $email
     * @param $name
     * @param $text
     * @param $ip
     * @param $fingerprint
     */
    public function __construct($id, $email, $name, $text, $ip, $fingerprint)
    {
        $this->id          = $id;
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
        $comment = $commentRepository->findById($this->id);

        $comment->email       = $this->email;
        $comment->name        = $this->name;
        $comment->text        = $this->text;
        $comment->ip          = $this->ip;
        $comment->fingerprint = $this->fingerprint;

        $commentRepository->save($comment);
    }
}
