<?php namespace Barryvanveen\Rss;

class FeedData
{
    /** @var  string */
    public $version;

    /** @var  string */
    public $encoding;

    /**
     * @param string $version
     * @param string $encoding
     */
    public function __construct($version = '2.0', $encoding = 'UTF-8')
    {
        $this->version = $version;
        $this->encoding = $encoding;
    }
}