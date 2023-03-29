<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\menu\viewmodels;  

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
        $menu_active = $this->container->exists('menu_active') ? $this->container->get('menu_active') : 'menu';
        $menu = $this->container->exists($menu_active) ? $this->container->get($menu_active) : [];
        $router = $this->container->get('router');
        return [
            'path_current' => $router->get('actualPath'),
            'logout_link' => $router->url('logout'),
            'link_admin' => $router->url(''),
            'menu' => $menu,
        ];
    }
}
