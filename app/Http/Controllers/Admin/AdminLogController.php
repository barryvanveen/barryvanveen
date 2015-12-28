<?php
namespace Barryvanveen\Http\Controllers\Admin;

use Barryvanveen\Http\Controllers\Controller;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;
use View;

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

        return View::make('packages.rap2hpoutre.laravel-log-viewer.log', [
            'logs'         => $logs,
            'files'        => LaravelLogViewer::getFiles(true),
            'current_file' => LaravelLogViewer::getFileName(),
        ]);
    }
}
