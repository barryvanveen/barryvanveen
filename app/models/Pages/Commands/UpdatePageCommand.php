<?php
namespace Barryvanveen\Pages\Commands;

class UpdatePageCommand
{
    public $id;
    public $title;
    public $text;
    public $online;

    /**
     * @param $id
     * @param $title
     * @param $text
     * @param $online
     *
     * @see UpdatePageHandler
     */
    public function __construct($id, $title, $text, $online)
    {
        $this->id     = $id;
        $this->title  = $title;
        $this->text   = $text;
        $this->online = $online;
    }
}
