<?php

namespace Barryvanveen\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Meta;

abstract class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function __construct()
    {
        $this->setPageTitle(trans('meta.pagetitle-default'), false);
    }

    /**
     * Set the page title.
     *
     * @param $title
     * @param bool $append
     */
    protected function setPageTitle($title, $append = true)
    {
        if ($append) {
            $old_title = Meta::get('title');

            $title = $title.' - '.$old_title;
        }

        Meta::set('title', $title);
    }

    /**
     * Set the meta description tag.
     *
     * @param $description
     */
    protected function setMetaDescription($description)
    {
        $description = strip_tags($description);

        Meta::set('description', $description);
    }
}
