<?php

namespace Barryvanveen\Composers;

use Cache;
use Illuminate\View\View;

class AssetComposer
{
    /** @var View */
    protected $view;

    /** @var array */
    protected $assets = [
        'dist/css/print.css'  => 'dist/css/print.css',
        'dist/css/screen.css' => 'dist/css/screen.css',
        'dist/js/main.js'     => 'dist/js/main.js',
        'dist/js/admin.js'    => 'dist/js/admin.js',
    ];

    /**
     * @param View $view
     */
    public function compose($view)
    {
        $this->view = $view;

        $this->view->with('critical_css', file_get_contents(public_path().'/dist/css/critical.css'));

        $this->getAssets();
    }

    protected function getAssets()
    {
        if ('production' != config('app.env')) {
            $this->view->with('assets', $this->assets);

            return;
        }

        if (Cache::has('assets')) {
            $this->assets = Cache::get('assets');
        } else {
            $this->assets = $this->createFileHashes($this->assets);
            Cache::forever('assets', $this->assets);
        }

        $this->view->with('assets', $this->assets);
    }

    /**
     * Create a short file hash for each asset.
     *
     * @param $assets
     */
    protected function createFileHashes($assets)
    {
        foreach ($assets as $key => $asset) {
            $path = public_path().'/'.$key;

            if (!file_exists($path)) {
                continue;
            }

            $hash = hash_file('crc32', $path);
            $dot = strripos($asset, '.');

            $assets[$key] = substr($asset, 0, $dot + 1).$hash.substr($asset, $dot);
        }

        return $assets;
    }
}
