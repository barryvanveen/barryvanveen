<?php

namespace Barryvanveen\Providers;

use App;
use Illuminate\Support\ServiceProvider;
use League\Glide\ServerFactory;

class GlideServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->app->singleton('League\Glide\Server', function (App $app) {
            /** @var \Illuminate\Contracts\Filesystem\Filesystem $filesystem */
            $filesystem = $app->make('Illuminate\Contracts\Filesystem\Filesystem');

            return ServerFactory::create([
                'source'            => $filesystem->getDriver(), // default: Dropbox
                'cache'             => storage_path(),            // local path
                'cache_path_prefix' => 'image-cache',
            ]);
        });
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
    }
}
