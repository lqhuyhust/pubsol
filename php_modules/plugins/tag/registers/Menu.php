<?php
namespace App\plugins\tag\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerMenu( IApp $app )
    {
        $container = $app->getContainer();
        $menu_root = $container->exists('menu') ? $container->get('menu') : [];
        $permission = $container->exists('permission') ? $container->get('permission') : null;
        $allow = $permission ? $permission->checkPermission(['tag_manager', 'tag_read']) : true;
        if (!$allow)
        {
            return false;
        }

        $menu = [
            [['tags', 'tag',], 'tags', 'Tags', '<i class="fa-solid fa-clipboard"></i>', '', ''],
        ];
        $menu_root[1] = isset($menu_root[1]) ? array_merge($menu_root[1], $menu) : $menu;
        $container->set('menu', $menu_root);
    }
}