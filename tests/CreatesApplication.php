<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        // set the public path to this directory
        $app->bind('path.public', function () {
            return __DIR__.'/../public_html';
        });

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}