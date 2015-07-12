<?php
namespace Barryvanveen\Http\Controllers\Admin;

use Barryvanveen\Http\Controllers\Controller;
use View;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $this->setPageTitle('Dashboard');

        return View::make('templates.admin.dashboard');
    }
}
