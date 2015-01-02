<?php

class PagesController extends BaseController
{
    public function home()
    {
        return View::make('pages.home');
    }

    public function elements()
    {
        return View::make('pages.elements');
    }
}
