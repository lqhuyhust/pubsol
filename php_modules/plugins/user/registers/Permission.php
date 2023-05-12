<?php

namespace App\plugins\user\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'user_manager', 'user_view', 'user_edit', 'user_delete'
            'usergroup_manager', 'usergroup_view', 'usergroup_edit', 'usergroup_delete'
        ];
    }

    public static function registerPermission()
    {
        return [
            'users' => [
                'get' => ['user_manger', 'user_view'],
                'post' => ['user_manger', 'user_view'],
                'put' => ['user_manager', 'user_edit'],
                'delete' => ['user_manager', 'user_delete'],
            ],
            'user' => [
                'get' => ['user_manger', 'user_edit'],
                'post' => ['user_manger', 'user_edit'],
                'put' => ['user_manger', 'user_edit'],
                'delete' => ['user_manger', 'user_delete']
            ],
            'user-groups' => [
                'get' => ['usergroup_manger', 'usergroup_view'],
                'post' => ['usergroup_manger', 'usergroup_view'],
                'put' => ['usergroup_manger', 'usergroup_edit'],
                'delete' => ['usergroup_manger', 'usergroup_delete']
            ],

            'user-group' => [
                'post' => 'user.usergroup.detail',
                'get' => 'user.usergroup.detail',
                'put' => 'user.usergroup.update',
                'delete' => 'user.usergroup.delete'
            ],
        ];
    }
}
