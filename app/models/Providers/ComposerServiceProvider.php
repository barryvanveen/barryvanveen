<?php namespace Barryvanveen\Providers;

use Auth;
use Barryvanveen\Composers\MenuComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Request;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {

        // Build menus
        $this->app->view->composer('layouts.partials.header', MenuComposer::class);

        // Header must know if this route is within the admin section
        $this->app->view->composer('layouts.partials.header', function ($view) {
            /** @var View $view */
            $view->with('is_admin', (Request::segment(1) === 'admin' && Request::segment(2) !== 'inloggen'))
                 ->with('current_user', Auth::user());
        });

        // GA tracking code
        $this->app->view->composer('layouts.partials.analytics', function ($view) {
            /** @var View $view */
            $view->with('ga_code', getenv('GA_CODE'));
        });
    }
}
