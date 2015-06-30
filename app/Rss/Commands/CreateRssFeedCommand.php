<?php
namespace Barryvanveen\Rss\Commands;

use Barryvanveen\Rss\ChannelData;
use Barryvanveen\Rss\FeedData;

class CreateRssFeedCommand
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
}
