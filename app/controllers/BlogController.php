<?php

class BlogController extends BaseController
{
    public function index()
    {
        return View::make('blog.full-list');
    }

    public function show()
    {
        return View::make('blog.item');
    }
}
