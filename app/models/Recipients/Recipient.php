<?php namespace Barryvanveen\Recipients;

class Recipient
{
    /** @var String $email */
    public $email;

    /** @var String $name */
    public $name;

    /**
     * Construct an email recipient
     *
     * @param string $email
     * @param string $name
     */
    public function __construct($email, $name)
    {
        $this->email = $email;
        $this->name = $name;
    }
}