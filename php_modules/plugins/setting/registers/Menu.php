<?php
namespace App\plugins\setting\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerMenu( IApp $app )
    {
        $container = $app->getContainer();
        $menu_root = $container->exists('menu') ? $container->get('menu') : [];
        $permission = $container->exists('permission') ? $container->get('permission') : null;
        $allow = $permission ? $permission->checkPermission(['setting_manager']) : true;
        if (!$allow)
        {
            return false;
        }

        $menu[] = [['settings', 'settings',], 'settings', 'Settings', '<i class="fa-solid fa-gear"></i>', []];

        $menu_root[10] = isset($menu_root[10]) ? array_merge($menu_root[10], $menu) : $menu;
        $container->set('menu', $menu_root);
    }
}