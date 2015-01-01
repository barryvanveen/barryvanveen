<?php

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


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [

            ['no-composer-update', null, InputOption::VALUE_NONE, 'Do not run composer-update.']

        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {

        if (!$this->option('no-composer-update')) {
            $this->runTask("composer update");
        }

        $this->runTask("bower install");

        $this->runTask("clearDatabase", getenv('DB_NAME'));
        $this->runTask("php artisan migrate");
        $this->runTask("php artisan db:seed");

        if (!getenv('DB_TESTING_NAME')) {
            $this->error("Zet DB_TESTING_NAME in .env.local.php om ook de testing-database te migraten");
            return;
        }

        $this->runTask("clearDatabase", getenv('DB_TESTING_NAME'));
        $this->runTask("php artisan migrate --env=testing");

    }

    /**
     * Run the given method or command
     *
     * @param String $command
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
     * Start the output of a task
     *
     * @param null|string $line
     */
    protected function startOutput($line = null)
    {
        $this->info("=========================================");
        if (!empty($line)) {
            $this->info("Starting: " . $line);
        }
    }

    /**
     * End the output of a sing task
     */
    protected function endOutput()
    {
        $this->info("\n\n");
    }


    /**
     * Delete all tables from the current database
     */
    protected function clearDatabase($db)
    {
        DB::statement('DROP DATABASE IF EXISTS `' . $db . '`;');
        DB::statement('CREATE DATABASE `' . $db . '`;');
    }

}