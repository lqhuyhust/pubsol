<?php
namespace App\plugins\version\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerMenu( IApp $app )
    {
        $container = $app->getContainer();
        $menu_root = $container->exists('menu') ? $container->get('menu') : [];

        $menu = [
            [['versions', 'version', 'version-notes', 'version-feedback'], 'versions', 'Versions', '<i class="fa-solid fa-code-branch"></i>', ''],
        ];

        $container->set('menu', array_merge($menu_root, $menu));
    }
}