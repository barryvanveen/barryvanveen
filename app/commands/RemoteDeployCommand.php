<?php

use Illuminate\Console\Command;

class RemoteDeployCommand extends Command
{
    const OBJECT_ARGUMENT_SEPARATOR = ':';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'remote:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All the procedures needed for deploying the website';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        if (!$this->confirm('Wil je echt deployen? [yes|no]', false)) {
            $this->info('Niet gedeployed. Klaar!');

            return;
        }

        $this->runTask('deploy');

        $this->info('Klaar!');
    }

    /**
     * Run the given method or command.
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
     * Start the output of a task.
     *
     * @param null|string $line
     */
    protected function startOutput($line = null)
    {
        $this->info('=========================================');
        if (!empty($line)) {
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
     * Deploy to the production environment using SSH.
     */
    protected function deploy()
    {
        SSH::into('production')->run([
            'php artisan down',
            'git pull origin master',
        ]);

        SSH::put('.env.production.php', '.env.php');

        SSH::into('production')->run([
            'composer install --no-dev',
            'php artisan migrate --force',
            'php artisan up',
        ]);
    }
}
