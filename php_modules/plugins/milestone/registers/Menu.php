<?php
namespace App\plugins\milestone\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerMenu( IApp $app )
    {
        $container = $app->getContainer();
        $menu_root = $container->exists('menu') ? $container->get('menu') : [];

        $permission = $container->exists('permission') ? $container->get('permission') : null;
        $allow_milestone = $permission ? $permission->checkPermission(['milestone_manager', 'milestone_read']) : true;
        $allow_request = $permission ? $permission->checkPermission(['request_manager', 'request_read']) : true;
        
        $entity = $container->get('MilestoneEntity');
        $router = $container->get('router');
        $path_current = $router->get('actualPath');
        $str = ['detail-request'];
        $check = false;
        foreach ($str as $item)
        {
            if (strpos($path_current, $item) !== false)
            {
                $check = true;
                break;
            }
        }
        if ($check && $allow_request)
        {
            $request = $container->get('request');
            $version = $container->exists('VersionEntity') ? $container->get('VersionEntity') : null;
            $app->set('menu_type', 'milestone');
            $urlVars = $request->get('urlVars');
            $request_id = (int) $urlVars['request_id'];
            $menu = [];

            $menu[1] = [
                [['detail-request/'. $request_id], 'detail-request/'. $request_id.'#relate_note_link', 'Relate Notes', '<i class="fa-solid fa-link"></i>', '', ''],
                [[], 'detail-request/'. $request_id.'#document_link', 'Document', '<i class="fa-regular fa-folder-open"></i>', '', ''],
                [[], 'detail-request/'. $request_id.'#task_link', 'Tasks', '<i class="fa-solid fa-list-check"></i>', '', ''],
            ];

            if ($version)
            {
                $menu[1][] = [[], 'detail-request/'. $request_id.'#version_link', 'Versions', '<i class="fa-solid fa-code-branch"></i>', '', ''];
            }
            $container->set('menu_active', 'request_menu');
            $container->set('request_menu', $menu);
            return ;
        }

        $list = $entity->list(0, 0, ['status = 1']);
        $menu = [];
        if ($allow_milestone)
        {
            $menu = [
                [['milestones', 'milestone', '',], 'milestones', 'Milestones', '<i class="fa-solid fa-business-time"></i>', ''],
            ];
        }

        if($allow_request)
        {
            foreach($list as $item)
            {
                $menu[] = [['requests/'. $item['id'],'request/'. $item['id']], 'requests/'. $item['id'], $item['title'], '<i class="me-4 pe-2"></i>', 'back-ground-sidebar'];
            }
        }

        $menu_root[1] = isset($menu_root[1]) ? array_merge($menu_root[1], $menu) : $menu;
        $container->set('menu', $menu_root);
    }
}