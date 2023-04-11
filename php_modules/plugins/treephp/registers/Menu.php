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

        $menu = [
            [['tree-phps', 'tree-php',], 'tree-phps', 'Tree PHP', ''],
        ];
        $menu_root = array_merge($menu_root, $menu);
        $container->set('reportMenu', $menu_root);
    }
}