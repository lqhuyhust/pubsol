<?php
namespace App\plugins\page\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerItem( IApp $app )
    {
        $container = $app->getContainer();
        $router = $container->get('router');
        $path_current = $router->get('actualPath');

        $active = strpos($path_current, 'pages') !== false ? 'active' : '';
        $active_template = strpos($path_current, 'templates') !== false ? 'active' : '';
        $menu = [
            [
                'link' => $router->url('pages'),
                'title' => 'Pages', 
                'icon' => '<i class="fa-solid fa-clipboard"></i>',
                'class' => $active,
            ],
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