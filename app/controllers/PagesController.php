<?php

class PagesController extends BaseController
{
    public function contact()
    {
        return View::make('pages.contact');
    }

    public function elements()
    {
        return View::make('pages.elements');
    }
}
