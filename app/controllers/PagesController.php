<?php

class PagesController extends BaseController
{
    public function home()
    {
        Head::title('Blog, projecten en persoonlijke website van Barry van Veen', false);

        return View::make('pages.home');
    }

    public function overMij()
    {
        Head::title('Wie is Barry van Veen en hoe kun je contact met hem opnemen?', false);

        return View::make('pages.over-mij');
    }

    public function elements()
    {
        Head::title('Elements');

        return View::make('pages.elements');
    }
}
