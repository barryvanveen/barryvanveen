<?php

namespace Barryvanveen\Console\Commands;

use Illuminate\Console\Command;

class VersionCommand extends Command
{
    const OBJECT_ARGUMENT_SEPARATOR = ':';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Output the current version number of this app';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Current version: '.config('app.version'));
    }
}
