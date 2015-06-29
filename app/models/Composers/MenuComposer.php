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
                'title'      => 'Blog',
                'routes'     => ['home', 'blog-item'],
                'classnames' => '',
            ],
            [
                'slug'       => route('over-mij'),
                'title'      => 'Over mij',
                'routes'     => ['over-mij', 'boeken'],
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
                'title'      => 'Dashboard',
                'routes'     => ['admin.dashboard'],
                'classnames' => '',
            ],
            [
                'slug'       => route('admin.blog'),
                'title'      => 'Blog',
                'routes'     => ['admin.blog', 'admin.blog-new', 'admin.blog-edit'],
                'classnames' => '',
            ],
            [
                'slug'       => route('admin.page'),
                'title'      => 'Pages',
                'routes'     => ['admin.page', 'admin.page-new', 'admin.page-edit'],
                'classnames' => '',
            ],
            [
                'slug'       => route('admin.logs'),
                'title'      => 'Logs',
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
