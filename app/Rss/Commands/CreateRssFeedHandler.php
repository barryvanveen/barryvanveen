<?php
namespace Barryvanveen\Rss\Commands;

use Barryvanveen\Rss\ItemData;
use Flyingfoxx\CommandCenter\CommandHandler;
use Thujohn\Rss\Rss;

class CreateRssFeedHandler implements CommandHandler
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
    public function handle($command)
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
