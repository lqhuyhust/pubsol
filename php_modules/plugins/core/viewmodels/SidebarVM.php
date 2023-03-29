<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\core\viewmodels;  

use SPT\Web\MVVM\ViewModel;

class SideBarVM extends ViewModel
{
    public static function register()
    {
        return [
            'widgets.backend.sidebar'
        ];
    }

    public function sidebar()
    {
        $app = $this->container->get('app');
        $app->loadPlugins('menu', 'registerMenu');
        
        $menu_active = $this->container->exists('menu_active') ? $this->container->get('menu_active') : 'menu';
        $menu_root = $this->container->exists($menu_active) ? $this->container->get($menu_active) : [];
        ksort($menu_root);
        $menu = [];
        foreach($menu_root as $menu_items)
        {
            $menu = array_merge($menu, $menu_items);
        }

        $router = $this->container->get('router');
        return [
            'path_current' => $router->get('actualPath'),
            'logout_link' => $router->url('logout'),
            'link_admin' => $router->url(''),
            'menu' => $menu,
        ];
    }
}
