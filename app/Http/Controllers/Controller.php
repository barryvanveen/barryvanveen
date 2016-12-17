<?php

namespace Barryvanveen\Http\Controllers;

use Meta;
use JavaScript;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->setPageTitle(trans('meta.pagetitle-default'), false);

        JavaScript::put([
            'markdownToHtmlRoute' => route('admin.markdown-to-html'),
        ]);
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
