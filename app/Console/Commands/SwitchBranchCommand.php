<?php

namespace Barryvanveen\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class SwitchBranchCommand extends Command
{
    const OBJECT_ARGUMENT_SEPARATOR = ':';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'switch-branch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All the procedures needed for switching a branch';

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [

            ['composer-update', null, InputOption::VALUE_NONE, 'Run composer update instead of composer install.'],

        ];
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->option('composer-update')) {
            $this->runTask('composer update');
        } else {
            $this->runTask('composer install');
        }

        $this->runTask('bower install');

        $this->runTask('clearDatabase', config('database.connections.mysql.database'));
        $this->runTask('php artisan migrate');
        $this->runTask('php artisan db:seed');

        if (! getenv('DB_TESTING_DATABASE')) {
            $this->error('Put a variable DB_TESTING_DATABASE in .env to automatically migrate the testing database.');

            return;
        }

        $this->runTask('clearDatabase', config('database.connections.mysql_testing.database'));
        $this->runTask('php artisan migrate --database=mysql_testing');
    }

    /**
     * Run the given method or command.
     *
     * @param string $command
     */
    protected function runTask($command, $value = null)
    {
        $this->startOutput($command);

        if (method_exists($this, $command)) {
            $this->$command($value);
        } else {
            passthru($command, $output);
        }

        $this->endOutput();
    }

    /**
     * Start the output of a task.
     *
     * @param null|string $line
     */
    protected function startOutput($line = null)
    {
        $this->info('=========================================');
        if (! empty($line)) {
            $this->info('Starting: '.$line);
        }
    }

    /**
     * End the output of a sing task.
     */
    protected function endOutput()
    {
        $this->info("\n\n");
    }

    /**
     * Delete all tables from the current database.
     */
    protected function clearDatabase($db)
    {
        DB::statement('DROP DATABASE IF EXISTS `'.$db.'`;');
        DB::statement('CREATE DATABASE `'.$db.'`;');
    }
}
