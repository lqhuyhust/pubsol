<?php
namespace App\plugins\report\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerMenu( IApp $app )
    {
        $container = $app->getContainer();
        $app->loadPlugins('Menu', 'registerReportMenu');
        
        $menu_report = $container->exists('reportMenu') ? $container->get('reportMenu') : [];
        if ($menu_report)
        {
            $menu_root = $container->exists('menu') ? $container->get('menu') : [];
            $menu[] = [['report', 'report',], 'report', 'Report Diagram', '<i class="fa-solid fa-magnifying-glass-chart"></i>', $menu_report];
            $menu_root[2] = isset($menu_root[2]) ? array_merge($menu_root[2], $menu) : $menu;
            $container->set('menu', $menu_root);
        }
    }
}