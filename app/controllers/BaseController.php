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

        $javascript_vars = [
            'baseurl'  => url(),
            'loggedin' => (Auth::user() ? true : false),
        ];

        if (Auth::check()) {
            $javascript_vars['markdownToHtmlRoute'] = route('admin.markdown-to-html');
        }

        JavaScript::put($javascript_vars);
    }
}
