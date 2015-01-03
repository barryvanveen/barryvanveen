<?php namespace Barryvanveen\Composers;

use Menu;

class MenuComposer
{

    public function compose()
    {
        Menu::make('MainNav', function ($menu) {

            /** @var \Lavary\Menu\Item $menu */

            // fill the menu
            // activate some items on all routes that start with the parents url
            $menu->add('Home', ['route' => 'home']);
            $menu->add('Blog', ['route' => 'blog'])
                 ->active(route('blog', [], false) . '/*');
            $menu->add('Projecten', ['route' => 'projects'])
                 ->active(route('projects', [], false) . '/*');
            $menu->add('Over mij', ['route' => 'over-mij']);
            $menu->add('Elements', ['route' => 'elements']);

        });

    }

}