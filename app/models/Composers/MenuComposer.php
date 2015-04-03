<?php namespace Barryvanveen\Composers;

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
            $menu->add('Home', ['route' => 'home']);
            $menu->add('Blog', ['route' => 'blog'])
                 ->active(route('blog', [], false).'/*');
            $menu->add('Over mij', ['route' => 'over-mij']);

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

        });
    }
}
