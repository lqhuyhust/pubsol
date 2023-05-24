<?php
namespace App\plugins\timeline\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerReportMenu( IApp $app )
    {
        $container = $app->getContainer();
        $menu_root = $container->exists('reportMenu') ? $container->get('reportMenu') : [];
        $permission = $container->exists('permission') ? $container->get('permission') : null;
        $allow = $permission ? $permission->checkPermission(['timeline_manager', 'timeline_read']) : true;
        if (!$allow)
        {
            return false;
        }
        
        $menu = [
            [['timeline', 'timeline',], 'timeline', 'Timeline', ''],
        ];
        $menu_root = array_merge($menu_root, $menu);
        $container->set('reportMenu', $menu_root);
    }
}