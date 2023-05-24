<?php

namespace App\plugins\user\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'user_manager', 'user_read', 'user_create', 'user_update', 'user_delete',
            'usergroup_manager', 'usergroup_read', 'usergroup_create', 'usergroup_update', 'usergroup_delete'
        ];
    }

    public static function registerPermission()
    {
        return [
            'users' => [
                'get' => ['user_manager', 'user_read'],
                'post' => ['user_manager', 'user_read'],
                'put' => ['user_manager', 'user_update'],
                'delete' => ['user_manager', 'user_delete'],
            ],
            'user' => [
                'get' => ['user_manager', 'user_read'],
                'post' => ['user_manager', 'user_create'],
                'put' => ['user_manager', 'user_update'],
                'delete' => ['user_manager', 'user_delete']
            ],
            'user-groups' => [
                'get' => ['usergroup_manager', 'usergroup_read'],
                'post' => ['usergroup_manager', 'usergroup_read'],
                'put' => ['usergroup_manager', 'usergroup_update'],
                'delete' => ['usergroup_manager', 'usergroup_delete']
            ],

            'user-group' => [
                'post' => ['usergroup_manager', 'usergroup_create'],
                'get' => ['usergroup_manager', 'usergroup_read'],
                'put' => ['usergroup_manager', 'usergroup_update'],
                'delete' => ['usergroup_manager', 'usergroup_delete']
            ],
        ];
    }

    public static function CheckSession(IApp $app)
    {
        $user = $app->getContainer()->get('user');
        $permission = $app->getContainer()->get('permission');

        if( is_object($user) && $user->get('id') )
        {
            $allow = $permission->checkPermission();
            if ($allow)
            {
                return true;
            }

            $app->redirect(
                $app->getRouter()->url('')
            );
        } 

        $app->redirect(
            $app->getRouter()->url('login')
        );
    }
}
