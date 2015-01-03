<?php

class BlogController extends BaseController
{
    public function index()
    {
        Head::title('Blog');

        return View::make('blog.full-list');
    }

    public function show()
    {
        // todo: replace with actual title
        Head::title('Blog titel');

        return View::make('blog.item');
    }
}
