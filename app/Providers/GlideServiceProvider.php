<?php

namespace Barryvanveen\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use League\Glide\ServerFactory;
use League\Glide\Server;

class GlideServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->singleton(Server::class, function (Application $app) {
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
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Server::class];
    }

}
