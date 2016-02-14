<?php
namespace Barryvanveen\Http\Controllers;

use Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use JavaScript;
use Meta;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // default page title
        $this->setPageTitle(trans('meta.pagetitle-default'), false);

        // default javascript variables
        $javascript_vars = [
            'baseurl'  => url(''),
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
    protected function setPageTitle($title, $append = true)
    {
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
    protected function setMetaDescription($description)
    {
        $description = strip_tags($description);

        Meta::meta('description', $description);
    }
}
