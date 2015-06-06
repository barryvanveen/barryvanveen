<?php

/*
 * This file is part of Laravel Flysystem.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'dropbox',

    /*
    |--------------------------------------------------------------------------
    | Flysystem Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Examples of
    | configuring each supported driver is shown below. You can of course have
    | multiple connections per driver.
    |
    */

    'connections' => [

        'dropbox' => [
            'driver' => 'dropbox',
            'token'  => getenv('DROPBOX_TOKEN'),
            'app'    => getenv('DROPBOX_APP'),
            'prefix' => getenv('DROPBOX_PREFIX'),
        ],

        'local' => [
            'driver' => 'local',
            'path'   => storage_path(),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Flysystem Cache
    |--------------------------------------------------------------------------
    |
    | Here are each of the cache configurations setup for your application.
    | There are currently two drivers: illuminate and adapter. Examples of
    | configuration are included. You can of course have multiple connections
    | per driver as shown.
    |
    */

    'cache' => [

        'adapter' => [
            'driver'  => 'adapter',
            'adapter' => 'local', // as defined in connections
            'file'    => 'flysystem.json',
            'ttl'     => 600,
        ],

    ],

];
