<?php
namespace Barryvanveen\Jobs\Rss;

use Barryvanveen\Rss\ChannelData;
use Barryvanveen\Rss\FeedData;
use Barryvanveen\Rss\ItemData;
use Feed;
use Illuminate\Contracts\Bus\SelfHandling;

class GetRssXml implements SelfHandling
{
    /** @var FeedData */
    public $feedData;

    /** @var ChannelData */
    public $channelData;

    /** @var array */
    public $itemDataArray;

    /**
     * @param FeedData    $feedData
     * @param ChannelData $channelData
     * @param array       $itemDataArray
     */
    public function __construct(FeedData $feedData, ChannelData $channelData, array $itemDataArray)
    {
        $this->feedData      = $feedData;
        $this->channelData   = $channelData;
        $this->itemDataArray = $itemDataArray;
    }

    /**
     * Handle a command.
     *
     * @return string
     */
    public function handle()
    {
        // make a feed
        $feed          = Feed::make();
        $feed->charset = $this->feedData->encoding;
        $feed->ctype   = $this->feedData->ctype;

        // configure channel
        $feed->description = $this->channelData->description;
        $feed->lang        = $this->channelData->language;
        $feed->link        = $this->channelData->link;
        $feed->pubdate     = $this->channelData->lastBuildDate;
        $feed->title       = $this->channelData->title;

        // add items
        foreach ($this->itemDataArray as $itemData) {
            /* @var ItemData $itemData */
            $feed->add(
                $itemData->title,
                null,
                $itemData->link,
                $itemData->pubDate,
                $itemData->description
            );
        }

        // select custom view
        $feed->setView('templates.rss');

        // return xml
        return $feed->render('rss', -1);
    }
}
