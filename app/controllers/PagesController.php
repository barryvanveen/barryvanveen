<?php

class PagesController extends BaseController
{
    public function home()
    {
        return View::make('pages.home');
    }

    public function overMij()
    {
        return View::make('pages.over-mij');
    }

    public function elements()
    {
        return View::make('pages.elements');
    }
}
