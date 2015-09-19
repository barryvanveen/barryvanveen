<?php
namespace Barryvanveen\Rss;

class ChannelData
{
    /** @var string */
    public $title;

    /** @var string */
    public $description;

    /** @var string */
    public $link;

    /** @var string */
    public $lastBuildDate;

    /** @var string  */
    public $language;

    /**
     * @param string $title         the name of the feed, if the feed corresponds  directly to a web site, the name
     *                              should match the name of the site.
     * @param string $description   a human-readable characterization or summary of the feed
     * @param string $link          identifies the URL of the web site associated with the feed
     * @param string $lastBuildDate the last date and time the content of the feed was updated in RFC-2822 format
     * @param string $language      the natural language employed in the feed as an ISO 639 language code
     */
    public function __construct($title, $description, $link, $lastBuildDate, $language = 'dut')
    {
        $this->title         = $title;
        $this->description   = $description;
        $this->link          = $link;
        $this->lastBuildDate = $lastBuildDate;
        $this->language      = $language;
    }
}
