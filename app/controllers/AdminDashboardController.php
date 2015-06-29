<?php

class AdminDashboardController extends BaseController
{
    public function index()
    {
        $this->setPageTitle('Dashboard');

        return View::make('templates.admin.dashboard');
    }
}
