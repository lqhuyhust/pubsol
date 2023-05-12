<?php

namespace App\plugins\treediagram\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'treediagram_manager', 'treediagram_view', 'treediagram_update', 'treediagram_create', 'treediagram_delete'
        ];
    }

    public static function registerPermission()
    {
        return [
            'tree-diagrams' => [
                'get' => ['treediagram_manager', 'treediagram_view'],
                'post' => ['treediagram_manager', 'treediagram_view'],
                'put' => ['treediagram_manager', 'treediagram_update'],
                'delete' => ['treediagram_manager', 'treediagram_delete']
            ],
            'tree-diagram' => [
                'get' =>  ['treediagram_manager', 'treediagram_view'],
                'post' =>  ['treediagram_manager', 'treediagram_create'],
                'put' =>  ['treediagram_manager', 'treediagram_update'],
                'delete' =>  ['treediagram_manager', 'treediagram_delete']
            ],
        ];
    }
}
