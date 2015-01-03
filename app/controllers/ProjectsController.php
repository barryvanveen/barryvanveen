<?php

class ProjectsController extends BaseController
{
    public function index()
    {
        Head::title('Projecten');

        return View::make('projects.full-list');
    }

    public function show()
    {
        // todo: replace with actual title
        Head::title('Project titel');

        return View::make('projects.item');
    }
}
