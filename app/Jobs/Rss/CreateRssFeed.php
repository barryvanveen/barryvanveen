<?php
namespace Barryvanveen\Jobs\Rss;

use Barryvanveen\Rss\ChannelData;
use Barryvanveen\Rss\FeedData;
use Barryvanveen\Rss\ItemData;
use Thujohn\Rss\Rss;

class CreateRssFeed
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
     *
     * @see CreateRssFeedCommandHandler
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
     * @return Rss
     */
    public function handle()
    {
        $rss = new Rss();

        $rss->feed(
            $this->feedData->version,
            $this->feedData->encoding
        );

        $rss->channel($this->channelData->getData());

        foreach ($this->itemDataArray as $itemData) {
            /* @var ItemData $itemData */
            $rss->item($itemData->getData());
        }

        return $rss;
    }
}
