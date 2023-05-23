<?php
namespace App\plugins\report\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerMenu( IApp $app )
    {
        $container = $app->getContainer();
        $app->plgLoad('Menu', 'registerReportMenu');
        
        $permission = $container->exists('permission') ? $container->get('permission') : null;
        $allow = $permission ? $permission->checkPermission(['report_manager', 'report_read']) : true;
        if (!$allow)
        {
            return false;
        }
        $menu_report = $container->exists('reportMenu') ? $container->get('reportMenu') : [];
        $menu_root = $container->exists('menu') ? $container->get('menu') : [];
        $menu[] = [['reports', 'reports',], 'reports', 'Report', '<i class="fa-solid fa-magnifying-glass-chart"></i>', []];
        if ($menu_report)
        {
            foreach($menu_report as $item)
            {
                $menu[] = $item;
            }
        }
        $menu_root[2] = isset($menu_root[2]) ? array_merge($menu_root[2], $menu) : $menu;
        $container->set('menu', $menu_root);
    }
}