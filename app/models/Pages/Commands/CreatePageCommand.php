<?php
namespace Barryvanveen\Pages\Commands;

class CreatePageCommand
{
    public $title;
    public $text;
    public $online;

    /**
     * @param $title
     * @param $text
     * @param $online
     *
     * @see CreatePageHandler
     */
    public function __construct($title, $text, $online)
    {
        $this->title  = $title;
        $this->text   = $text;
        $this->online = $online;
    }
}
