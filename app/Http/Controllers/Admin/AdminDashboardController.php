<?php

namespace Barryvanveen\Http\Controllers\Admin;

use View;
use Barryvanveen\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $this->setPageTitle(trans('meta.pagetitle-admin-dashboard'));

        return View::make('templates.admin.dashboard');
    }
}
