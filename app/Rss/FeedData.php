<?php
namespace Barryvanveen\Rss;

class FeedData
{
    /** @var  string */
    public $encoding;

    /** @var string  */
    public $ctype;

    /**
     * @param string $encoding
     * @param string $ctype
     */
    public function __construct($encoding = 'UTF-8', $ctype = 'application/rss+xml')
    {
        $this->encoding = $encoding;
        $this->ctype = $ctype;
    }
}
