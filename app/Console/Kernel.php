<?php
namespace Barryvanveen\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // todo: move all Commands to /jobs
        // todo: move all Hanlders to /listeners
        \Barryvanveen\Console\Commands\DeployCommand::class,
        \Barryvanveen\Console\Commands\SwitchBranchCommand::class,
        \Barryvanveen\Console\Commands\UpdateLuckyTvRssFeedCommand::class,
        \Barryvanveen\Console\Commands\VersionCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
    }
}
