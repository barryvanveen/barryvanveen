<?php
namespace Barryvanveen\Rss\Commands;

use Barryvanveen\Rss\ItemData;
use Thujohn\Rss\Rss;

class CreateRssFeedCommandHandler
{
    /**
     * @see CreateRssFeedCommand
     */
    public function __construct()
    {
    }

    /**
     * Handle a command.
     *
     * @param CreateRssFeedCommand $command
     *
     * @return Rss
     */
    public function handle(CreateRssFeedCommand $command)
    {
        $rss = new Rss();

        $rss->feed(
            $command->feedData->version,
            $command->feedData->encoding
        );

        $rss->channel($command->channelData->getData());

        foreach ($command->itemDataArray as $itemData) {
            /* @var ItemData $itemData */
            $rss->item($itemData->getData());
        }

        return $rss;
    }
}
