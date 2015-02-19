<?php namespace Barryvanveen\Composers;

use Menu;

class MenuComposer
{
    public function compose()
    {
        Menu::make('MainNav', function ($menu) {

            // fill the menu
            // activate some items on all routes that start with the parents url
            /** @var \Lavary\Menu\Item $menu */
            $menu->add('Home', ['route' => 'home']);
            $menu->add('Blog', ['route' => 'blog'])
                 ->active(route('blog', [], false).'/*');
            /*$menu->add('Projecten', ['route' => 'projects'])
                 ->active(route('projects', [], false).'/*');*/
            $menu->add('Over mij', ['route' => 'over-mij']);
            /*$menu->add('Elements', ['route' => 'elements']);*/

        });

        Menu::make('AdminNav', function ($menu) {

            // fill the menu
            // activate some items on all routes that start with the parents url
            /** @var \Lavary\Menu\Item $menu */
            $menu->add('Dashboard', ['route' => 'admin.dashboard']);
            $menu->add('Blog', ['route' => 'admin.blog'])
                 ->active(route('admin.blog', [], false).'/*');
            $menu->add('Pages', ['route' => 'admin.pages'])
                 ->active(route('admin.pages', [], false).'/*');

        });

    }
}
