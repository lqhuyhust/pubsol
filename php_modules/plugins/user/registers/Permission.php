<?php

namespace App\plugins\user\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'user_manager', 'user_view', 'user_create', 'user_update', 'user_delete',
            'usergroup_manager', 'usergroup_view', 'usergroup_create', 'usergroup_update', 'usergroup_delete'
        ];
    }

    public static function registerPermission()
    {
        return [
            'users' => [
                'get' => ['user_manager', 'user_view'],
                'post' => ['user_manager', 'user_view'],
                'put' => ['user_manager', 'user_update'],
                'delete' => ['user_manager', 'user_delete'],
            ],
            'user' => [
                'get' => ['user_manager', 'user_view'],
                'post' => ['user_manager', 'user_create'],
                'put' => ['user_manager', 'user_update'],
                'delete' => ['user_manager', 'user_delete']
            ],
            'user-groups' => [
                'get' => ['usergroup_manager', 'usergroup_view'],
                'post' => ['usergroup_manager', 'usergroup_view'],
                'put' => ['usergroup_manager', 'usergroup_update'],
                'delete' => ['usergroup_manager', 'usergroup_delete']
            ],

            'user-group' => [
                'post' => ['usergroup_manager', 'usergroup_create'],
                'get' => ['usergroup_manager', 'usergroup_view'],
                'put' => ['usergroup_manager', 'usergroup_update'],
                'delete' => ['usergroup_manager', 'usergroup_delete']
            ],
        ];
    }
}
