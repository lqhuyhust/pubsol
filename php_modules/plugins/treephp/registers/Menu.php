<?php
namespace App\plugins\treephp\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerReportMenu( IApp $app )
    {
        $container = $app->getContainer();
        $menu_root = $container->exists('reportMenu') ? $container->get('reportMenu') : [];
        $permission = $container->exists('permission') ? $container->get('permission') : null;
        $allow = $permission ? $permission->checkPermission(['treephp_manager', 'treephp_read']) : true;
        if (!$allow)
        {
            return false;
        }
        
        $menu = [
            [['tree-phps', 'tree-php',], 'tree-phps', 'Tree PHP', ''],
        ];
        $menu_root = array_merge($menu_root, $menu);
        $container->set('reportMenu', $menu_root);
    }
}