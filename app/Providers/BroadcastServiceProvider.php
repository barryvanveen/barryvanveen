<?php

namespace Barryvanveen\Providers;

use Barryvanveen\Users\User;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Broadcast::routes();

        /*
         * Authenticate the user's personal channel...
         */
        Broadcast::channel('App.User.*', function (User $user, $userId) {
            return (int) $user->id === (int) $userId;
        });
    }
}
