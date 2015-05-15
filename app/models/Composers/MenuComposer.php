<?php
namespace Barryvanveen\Composers;

use Lavary\Menu\Item;
use Menu;

class MenuComposer
{
    public function compose()
    {
        Menu::make('MainNav', function ($menu) {

            // fill the menu
            // activate some items on all routes that start with the parents url
            /* @var Item $menu */
            $menu->add('Blog', ['route' => 'home'])
                 ->active('blog/*');
            $menu->add('Over mij', ['route' => 'over-mij'])
                 ->active('over-mij/*');

        });

        Menu::make('AdminNav', function ($menu) {

            // fill the menu
            // activate some items on all routes that start with the parents url
            /* @var Item $menu */
            $menu->add('Dashboard', ['route' => 'admin.dashboard']);
            $menu->add('Blog', ['route' => 'admin.blog'])
                 ->active(route('admin.blog', [], false).'/*');
            $menu->add('Pages', ['route' => 'admin.page'])
                 ->active(route('admin.page', [], false).'/*');
            $menu->add('Logs', ['route' => 'admin.logs']);

        });
    }
}
