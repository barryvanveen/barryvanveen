<?php

class BaseController extends Controller
{
    public function __construct()
    {
        // default page title
        $this->setPageTitle('Barry van Veen', false);

        // default robots meta tag
        $this->setMetaRobots('index,follow');
    }

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

    /**
     * Set the page title.
     *
     * @param $title
     * @param bool $append
     */
    protected function setPageTitle($title, $append = true) {
        if ($append) {
            $old_title = Meta::title();

            $title = $title.' - '.$old_title;
        }

        Meta::title($title);
    }

    /**
     * Set the meta description tag.
     *
     * @param $description
     */
    protected function setMetaDescription($description) {
        $description = strip_tags($description);

        Meta::meta('description', $description);
    }

    /**
     * Set the meta robots tag.
     *
     * @param $robots
     */
    protected function setMetaRobots($robots) {
        Meta::meta('robots', $robots);
    }
}
