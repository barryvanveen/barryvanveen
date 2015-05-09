<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class DeployCommand extends Command
{
    const OBJECT_ARGUMENT_SEPARATOR = ':';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All the procedures needed for deploying the website';

    /**
     * Return the arguments for this command.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['versie', InputArgument::REQUIRED, 'Versie die je wilt deployen, bijvoorbeeld v1.0.0'],
        ];
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

        $versie = $this->argument('versie');

        $this->info('Deploy versie '.$versie);
        Log::info('Deploy versie '.$versie);

        $this->runTask('deploy');

        $this->info('Klaar met deployen van versie '.$versie.'!');
        Log::info('Klaar met deployen van versie '.$versie.'!');
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
        $logfile        = 'storage/logs/'.date('YmdHis').'.log';
        $redirecttofile = ' | tee -a '.$logfile.' 2>&1';

        SSH::into('production')->run(
            [
                'php artisan down'.$redirecttofile,
                'git pull origin master '.$this->argument('versie').$redirecttofile,
            ]
        );

        SSH::put('.env.production.php', '.env.php');

        SSH::into('production')->run(
            [
                'composer install --no-dev'.$redirecttofile,
                'php artisan migrate --force'.$redirecttofile,
                'php artisan up'.$redirecttofile,
            ]
        );
    }
}
