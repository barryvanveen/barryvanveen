<?php

use Intervention\Image\ImageManager;
use League\Glide\Api\Api;
use League\Glide\Api\Manipulator\Output;
use League\Glide\Api\Manipulator\Size;
use League\Glide\Server;

class ImagesController extends BaseController
{
    /** @var  League\Glide\Server $server */
    protected $server;

    /** @var array */
    public static $allowed_parameters = [
        'w',
        'h',
    ];

    /**
     *
     */
    public function __construct()
    {
        // Set image source
        $source = Flysystem::connection('dropbox');

        // Set image cache
        $cache = Flysystem::connection('local');

        // Set image manager
        $imageManager = new ImageManager([
            'driver' => 'gd',
        ]);

        // Set manipulators
        $manipulators = [
            new Size(),
            new Output(),
        ];

        // Set API
        $api = new Api($imageManager, $manipulators);

        // Setup Glide server
        $this->server = new Server($source, $cache, $api);

        $this->server->setCachePathPrefix('image-cache');
    }

    /**
     * display an (possibly resized) image.
     *
     * @param string $filename
     *
     * @return mixed
     */
    public function show($filename)
    {
        $params = [
            'fit' => 'max',
        ];

        // add any allowed parameters
        foreach (Input::all() as $key => $value) {
            if (in_array($key, self::$allowed_parameters)) {
                $params[$key] = $value;
            }
        }

        return $this->server->outputImage($filename, $params);
    }
}
