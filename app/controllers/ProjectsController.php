<?php

class ProjectsController extends BaseController
{
    public function index()
    {
        return View::make('projects.full-list');
    }

    public function show()
    {
        return View::make('projects.item');
    }
}
