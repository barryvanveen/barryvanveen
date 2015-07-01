<?php

namespace Barryvanveen\Providers;

use League\Glide\ServerFactory;
use Illuminate\Support\ServiceProvider;

class GlideServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('League\Glide\Server', function($app){
            /** @var \App $app */
            /** @var \Illuminate\Contracts\Filesystem\Filesystem $filesystem */
            $filesystem = $app->make('Illuminate\Contracts\Filesystem\Filesystem');

            return ServerFactory::create([
                'source' => $filesystem->getDriver(), // default: Dropbox
                'cache' => storage_path(),            // local path
                'cache_path_prefix' => 'image-cache',
            ]);
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}