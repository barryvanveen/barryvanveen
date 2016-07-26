<?php
namespace Barryvanveen\Composers;

use Illuminate\View\View;
use Route;

class MenuComposer
{
    /** @var  View */
    protected $view;

    /**
     * @param View $view
     */
    public function compose($view)
    {
        $this->view = $view;

        $this->buildDefaultNavigation();

        $this->buildAdminNavigation();
    }

    private function buildDefaultNavigation()
    {
        $menu = [
            [
                'slug'       => route('home'),
                'title'      => trans('routes.home'),
                'routes'     => ['home', 'blog-item'],
                'classnames' => '',
            ],
            [
                'slug'       => route('about-me'),
                'title'      => trans('routes.about-me'),
                'routes'     => ['about-me', 'books'],
                'classnames' => '',
            ],
        ];

        $menu = $this->setActiveMenuItem($menu);

        $this->view->with('mainnav', $menu);
    }

    private function buildAdminNavigation()
    {
        $menu = [
            [
                'slug'       => route('admin.dashboard'),
                'title'      => trans('routes.admin-dashboard'),
                'routes'     => ['admin.dashboard'],
                'classnames' => '',
            ],
            [
                'slug'       => route('admin.blog'),
                'title'      => trans('routes.admin-blog'),
                'routes'     => ['admin.blog', 'admin.blog-new', 'admin.blog-edit'],
                'classnames' => '',
            ],
            [
                'slug'       => route('admin.comments'),
                'title'      => trans('routes.admin-comments'),
                'routes'     => ['admin.comments', 'admin.comments-edit'],
                'classnames' => '',
            ],
            [
                'slug'       => route('admin.page'),
                'title'      => trans('routes.admin-pages'),
                'routes'     => ['admin.page', 'admin.page-new', 'admin.page-edit'],
                'classnames' => '',
            ],
            [
                'slug'       => route('admin.logs'),
                'title'      => trans('routes.admin-logs'),
                'routes'     => ['admin.logs'],
                'classnames' => '',
            ],
        ];

        $menu = $this->setActiveMenuItem($menu);

        $this->view->with('adminnav', $menu);
    }

    /**
     * Set one menuitem as active based on the routes it belongs to.
     *
     * @param array $menu
     *
     * @return array
     */
    private function setActiveMenuItem($menu)
    {
        foreach ($menu as $key => $menuitem) {
            if (in_array(Route::currentRouteName(), $menuitem['routes'])) {
                $menu[$key]['classnames'] .= ' active';
                break;
            }
        }

        return $menu;
    }
}
