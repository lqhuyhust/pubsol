<?php
namespace App\plugins\template\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerItem( IApp $app )
    {
        $container = $app->getContainer();
        $router = $container->get('router');
        $path_current = $router->get('actualPath');

        $active_template = strpos($path_current, 'templates') !== false ? 'active' : '';
        $menu = [
            [
                'link' => $router->url('templates'),
                'title' => 'Templates', 
                'icon' => '<i class="fa-solid fa-clipboard"></i>',
                'class' => $active_template,
            ],
        ];
        
        return [
            'menu' => $menu,
            'order' => 3,
        ];
    }
}