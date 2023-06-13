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

use SPT\Web\ViewModel;

class SideBar extends ViewModel
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
        $router = $this->container->get('router');

        $menu_register = [];
        $app->plgLoad('menu', 'registerItem', function($menu) use (&$menu_register){
            if (is_array($menu) && $menu)
            {
                $order = 1;
                if (isset($menu['order']))
                {
                    $order = $menu['order'];
                    unset($menu['order']);
                }
                foreach($menu as $key => $item)
                {
                    $menu_register[$key][$order] = array_merge($menu_register[$key][$order] ?? [], $menu[$key]);
                }
                
            }
        });
        $menu_type = $app->get('menu_type', 'menu');
        $menu = isset($menu_register[$menu_type]) ? $menu_register[$menu_type] : [];
        ksort($menu);

        $menu_sidebar = [];
        foreach($menu as $menu_items)
        {
            $menu_sidebar = array_merge($menu_sidebar, $menu_items);
        }
        return [
            'logout_link' => $router->url('logout'),
            'link_admin' => $router->url(''),
            'menu' => $menu_sidebar,
        ];
    }
}
