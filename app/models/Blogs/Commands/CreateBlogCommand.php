<?php namespace Barryvanveen\Blogs\Commands;

class CreateBlogCommand
{
    public $title;
    public $summary;
    public $text;
    public $publication_date;
    public $online;

    /**
     * @param $title
     * @param $summary
     * @param $text
     * @param $publication_date
     * @param $online
     *
     * @see CreateBlogHandler
     */
    public function __construct($title, $summary, $text, $publication_date, $online)
    {
        $this->title            = $title;
        $this->summary          = $summary;
        $this->text             = $text;
        $this->publication_date = $publication_date;
        $this->online           = $online;
    }
}
