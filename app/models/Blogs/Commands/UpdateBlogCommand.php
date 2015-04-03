<?php namespace Barryvanveen\Blogs\Commands;

class UpdateBlogCommand
{
    public $id;
    public $title;
    public $summary;
    public $text;
    public $publication_date;
    public $online;

    /**
     * @param $id
     * @param $title
     * @param $summary
     * @param $text
     * @param $publication_date
     * @param $online
     *
     * @see UpdateBlogHandler
     */
    public function __construct($id, $title, $summary, $text, $publication_date, $online)
    {
        $this->id               = $id;
        $this->title            = $title;
        $this->summary          = $summary;
        $this->text             = $text;
        $this->publication_date = $publication_date;
        $this->online           = $online;
    }
}
