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

    /** @var int */
    public $ttl;

    /**
     * @param string $title         the name of the feed, if the feed corresponds  directly to a web site, the name
     *                              should match the name of the site.
     * @param string $description   a human-readable characterization or summary of the feed
     * @param string $link          identifies the URL of the web site associated with the feed
     * @param string $lastBuildDate the last date and time the content of the feed was updated in format
     *                              'D, d M Y H:i:s O'
     * @param string $language      the natural language employed in the feed as an ISO 639 language code
     * @param int    $ttl           the feed's time to live: the maximum number of minutes to cache the data
     */
    public function __construct($title, $description, $link, $lastBuildDate, $language = 'dut', $ttl = 60)
    {
        $this->title         = $title;
        $this->description   = $description;
        $this->link          = $link;
        $this->lastBuildDate = $lastBuildDate;
        $this->language      = $language;
        $this->ttl           = $ttl;
    }

    /**
     * Get the data of this channelData as an array.
     *
     * @return array
     */
    public function getData()
    {
        return [
            'title'         => $this->title,
            'description'   => $this->description,
            'link'          => $this->link,
            'language'      => $this->language,
            'ttl'           => $this->ttl,
            'lastBuildDate' => $this->lastBuildDate,
        ];
    }
}
