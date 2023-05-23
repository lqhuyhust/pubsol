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
        $DiagramEntity = $container->get('DiagramEntity');
        $allow = $permission ? $permission->checkPermission(['treephp_manager', 'treephp_read']) : true;
        if (!$allow)
        {
            return false;
        }
        
        $list = $DiagramEntity->list(0, 0, ['report_type' => 'tree_php']);
        $menu = [];
        foreach($list as $item)
        {
            $menu[] = [['tree-php/'. $item['id'],'tree-php/'. $item['id']], 'tree-php/'. $item['id'], $item['title'], '<i class="me-4 pe-2"></i>', 'back-ground-sidebar'];
        }
        
        $menu_root = array_merge($menu_root, $menu);
        $container->set('reportMenu', $menu_root);
    }
}