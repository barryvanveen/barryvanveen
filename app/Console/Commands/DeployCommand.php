<?php
namespace Barryvanveen\Console\Commands;

use Illuminate\Console\Command;
use SSH;
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
            ['version', InputArgument::REQUIRED, 'Version that you want to deploy. For example: v1.2.3'],
        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->confirm('Do you really want to deploy?', false)) {
            $this->info('Deploy cancelled.');

            return;
        }

        $version = $this->argument('version');

        $this->info('Deploying version '.$version);

        $this->deploy();

        $this->info('Deployed version '.$version.'!');
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
                'php artisan version'.$redirecttofile,
                'php artisan down'.$redirecttofile,
                'git pull origin master '.$this->argument('version').$redirecttofile,
            ]
        );

        SSH::put('.env.production', '.env');

        SSH::into('production')->run(
            [
                'composer install --no-dev'.$redirecttofile,
                'php artisan migrate --force'.$redirecttofile,
                'php artisan config:cache'.$redirecttofile,
                'php artisan route:cache'.$redirecttofile,
                'php artisan up'.$redirecttofile,
            ]
        );
    }
}
