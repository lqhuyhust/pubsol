<?php
namespace App\plugins\calendar\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerReportMenu( IApp $app )
    {
        $container = $app->getContainer();
        $menu_root = $container->exists('reportMenu') ? $container->get('reportMenu') : [];
        $permission = $container->exists('permission') ? $container->get('permission') : null;
        $allow = $permission ? $permission->checkPermission(['calendar_manager', 'calendar_view']) : true;
        $menu = [];
        if ($allow)
        {
            $menu = [
                [['calendar', 'calendar',], 'calendar', 'Calendar', ''],
            ];
        }
        
        $menu_root = array_merge($menu_root, $menu);
        $container->set('reportMenu', $menu_root);
    }
}