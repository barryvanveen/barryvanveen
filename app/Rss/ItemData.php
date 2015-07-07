<?php
namespace Barryvanveen\Rss;

class ItemData
{
    /** @var string */
    public $title;

    /** @var string */
    public $link;

    /** @var string */
    public $guid;

    /** @var string */
    public $pubDate;

    /** @var bool|string */
    public $description;

    /**
     * @param string $title       character data that provides the item's headline
     * @param string $link        the URL of a web page associated with the item
     * @param string $guid        string that uniquely identifies the item
     * @param string $pubDate     the publication date and time of the item in format 'D, d M Y H:i:s O'
     * @param bool   $description character data that contains the item's full content or a summary of its contents
     */
    public function __construct($title, $link, $guid, $pubDate, $description = false)
    {
        $this->title       = $title;
        $this->link        = $link;
        $this->guid        = $guid;
        $this->pubDate     = $pubDate;
        $this->description = $description;
    }
}
