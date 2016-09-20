<?php
namespace Barryvanveen\Http\Controllers;

use Input;
use League\Glide\Server;

class ImagesController extends Controller
{
    /** @var Server */
    protected $server;

    /** @var array */
    public static $allowed_parameters = [
        'w',
        'h',
    ];

    /**
     * @param Server $server
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
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
