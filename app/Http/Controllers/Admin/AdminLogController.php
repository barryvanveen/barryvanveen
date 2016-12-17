<?php

namespace Barryvanveen\Http\Controllers\Admin;

use View;
use Barryvanveen\Http\Controllers\Controller;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;

class AdminLogController extends Controller
{
    /**
     * @see LogViewerController
     */
    public function index()
    {
        $this->setPageTitle(trans('meta.pagetitle-admin-logs'));

        if (\Input::get('l')) {
            LaravelLogViewer::setFile(base64_decode(\Input::get('l')));
        }

        $logs = LaravelLogViewer::all();

        $files = LaravelLogViewer::getFiles(true);
        $options = [];
        foreach ($files as $file) {
            $options[base64_encode($file)] = $file;
        }

        return View::make('packages.rap2hpoutre.laravel-log-viewer.log', [
            'logs'         => $logs,
            'files'        => $options,
            'current_file' => base64_encode(LaravelLogViewer::getFileName()),
        ]);
    }
}
