<?php

namespace Barryvanveen\Providers;

use Auth;
use Barryvanveen\Composers\AssetComposer;
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
        /** @var \Illuminate\View\Factory $view */
        $view = view();

        // Produce cachebusting links to assets
        $view->composer('layout', AssetComposer::class);

        // Build menus
        $view->composer('layouts.partials.header', MenuComposer::class);

        // Header must know if this route is within the admin section
        $view->composer(['layout', 'layouts.partials.header'], function (View $view) {
            $view->with('is_admin', ('admin' === Request::segment(1) && 'inloggen' !== Request::segment(2)))
                 ->with('current_user', Auth::user());
        });
    }
}
