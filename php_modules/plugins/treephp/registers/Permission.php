<?php

namespace App\plugins\treephp\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'treephp_manager', 'treephp_read', 'treephp_create', 'treephp_update', 'treephp_delete' 
        ];
    }

    public static function registerPermission()
    {
        return [
            'tree-phps' => [
                'get' => ['treephp_manager', 'treephp_read'],
                'post' => ['treephp_manager', 'treephp_read'],
                'put' => ['treephp_manager', 'treephp_update'],
                'delete' => ['treephp_manager', 'treephp_delete']
            ],
            'tree-php' => [
                'get' =>  ['treephp_manager', 'treephp_read'],
                'post' =>  ['treephp_manager', 'treephp_create'],
                'put' =>  ['treephp_manager', 'treephp_update'],
                'delete' =>  ['treephp_manager', 'treephp_delete']
            ],
        ];
    }
}
