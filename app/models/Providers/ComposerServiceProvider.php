<?php namespace Barryvanveen\Providers;

use Barryvanveen\Composers\MenuComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        // GA tracking code
        $this->app->view->composer('layouts.partials.analytics', function ($view) {
            /** @var View $view */
            $view->with('ga_code', getenv('GA_CODE'));
        });

        // menu
        $this->app->view->composer('layouts.partials.header', MenuComposer::class);
    }
}
