<?php

class AdminPagesController extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        Head::title('Blog');

        return View::make('pages.admin.blog');
    }
}
