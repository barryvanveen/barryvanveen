<?php
namespace Barryvanveen\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        // register extra service providers on local environment
        if (config('app.env') == 'local') {
            $this->app->register('Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider');
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');

            $this->app->alias('Debugbar', 'Barryvdh\Debugbar\Facade');
        }
    }
}
