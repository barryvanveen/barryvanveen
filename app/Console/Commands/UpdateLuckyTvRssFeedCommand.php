<?php

namespace Barryvanveen\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;
use Barryvanveen\Jobs\LuckyTV\GetLuckyTVRssXml;

class UpdateLuckyTvRssFeedCommand extends Command
{
    const OBJECT_ARGUMENT_SEPARATOR = ':';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'update-luckytv-rss-feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the LuckyTV RSS feed';

    /** @var Dispatcher $dispatcher */
    private $dispatcher;

    /**
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        parent::__construct();

        $this->dispatcher = $dispatcher;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->dispatcher->dispatch(new GetLuckyTVRssXml());
    }
}
