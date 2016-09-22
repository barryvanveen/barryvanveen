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
    public $online;

    /**
     * @param $id
     * @param $email
     * @param $name
     * @param $text
     * @param $ip
     * @param $fingerprint
     * @param $online
     */
    public function __construct($id, $email, $name, $text, $ip, $fingerprint, $online)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->text = $text;
        $this->ip = $ip;
        $this->fingerprint = $fingerprint;
        $this->online = $online;
    }

    /**
     * Handle a command.
     *
     * @param CommentRepository $commentRepository
     *
     * @return void
     */
    public function handle(CommentRepository $commentRepository)
    {
        $comment = $commentRepository->findById($this->id);

        $comment->email = $this->email;
        $comment->name = $this->name;
        $comment->text = $this->text;
        $comment->ip = $this->ip;
        $comment->fingerprint = $this->fingerprint;
        $comment->online = $this->online;

        $commentRepository->save($comment);
    }
}
