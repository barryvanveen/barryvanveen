<?php

class BaseController extends Controller
{
    /**
     * Setup the layout used by the controller.
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }

        JavaScript::put([
            'baseurl'  => url(),
            'loggedin' => (Auth::user() ? true : false),
        ]);
    }
}
