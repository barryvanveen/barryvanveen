<?php namespace Barryvanveen\Console\Commands;

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
            ['versie', InputArgument::REQUIRED, 'Versie die je wilt deployen, bijvoorbeeld v1.0.0'],
        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->confirm('Wil je echt deployen? [yes|no]', false)) {
            $this->info('Niet gedeployed. Klaar!');

            return;
        }

        $versie = $this->argument('versie');

        $this->info('Deploy versie '.$versie);

        $this->deploy();

        $this->info('Klaar met deployen van versie '.$versie.'!');
    }

    /**
     * Deploy to the production environment using SSH.
     */
    protected function deploy()
    {
        $logfile        = 'storage/logs/'.date('YmdHis').'.log';
        $redirecttofile = ' | tee -a '.$logfile.' 2>&1';

        // todo: include SSH
        SSH::into('production')->run(
            [
                'php artisan version'.$redirecttofile,
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
