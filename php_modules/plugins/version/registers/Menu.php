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
        $permission = $container->exists('permission') ? $container->get('permission') : null;
        $allow = $permission ? $permission->checkPermission(['version_manager', 'version_read']) : true;
        if (!$allow)
        {
            return false;
        }
        $menu = [
            [['versions', 'version', 'version-notes', 'version-feedback'], 'versions', 'Versions', '<i class="fa-solid fa-code-branch"></i>', ''],
        ];

        $menu_root[5] = isset($menu_root[5]) ? array_merge($menu_root[5], $menu) : $menu;
        $container->set('menu', $menu_root);
    }
}