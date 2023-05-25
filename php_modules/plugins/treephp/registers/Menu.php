<?php
namespace App\plugins\treephp\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerReportItem( IApp $app )
    {
        $container = $app->getContainer();
        $router = $container->get('router');
        $path_current = $router->get('actualPath');
        $permission = $container->exists('permission') ? $container->get('permission') : null;
        $DiagramEntity = $container->get('DiagramEntity');
        $allow = $permission ? $permission->checkPermission(['treephp_manager', 'treephp_read']) : true;
        if (!$allow)
        {
            return false;
        }
        
        $list = $DiagramEntity->list(0, 0, ['report_type' => 'tree_php', 'status' => 1]);
        $menu = [];
        foreach($list as $item)
        {
            $active = strpos($path_current, 'tree-php/'. $item['id']) !== false ? 'active' : '';
            $menu[] = [
                'link' => $router->url('tree-php/'. $item['id']),
                'title' => $item['title'], 
                'icon' => '',
                'class' => 'back-ground-sidebar ' . $active,
            ];
        }
        
        return $menu;
    }
}