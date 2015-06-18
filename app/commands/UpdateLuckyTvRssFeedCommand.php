<?php

use Barryvanveen\LuckyTV\Commands\CreateLuckyTVRssFeedCommand;
use Flyingfoxx\CommandCenter\CommandBus;
use Illuminate\Console\Command;

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

    /** @var CommandBus $commandBus */
    private $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        parent::__construct();

        $this->commandBus = $commandBus;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->commandBus->execute(new CreateLuckyTVRssFeedCommand());
    }
}
