<?php namespace Barryvanveen\Providers;

use Barryvanveen\Composers\MenuComposer;
use Illuminate\Support\ServiceProvider;
use JavaScript;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        // checkboxes met tags toevoegen aan views
        $this->app->view->composer('layouts.partials.header', MenuComposer::class);

        if (\Session::has('flash_notification.message')) {
            JavaScript::put(['alert' => [
                                     'message' => \Session::get('flash_notification.message'),
                                     'level' => \Session::get('flash_notification.level'),
                                 ],
            ]);
        }
    }
}
