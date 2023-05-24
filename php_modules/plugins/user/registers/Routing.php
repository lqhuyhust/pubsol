<?php

namespace App\plugins\user\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'login' => [
                'fnc' => [
                    'get' => 'user.user.gate',
                    'post' => 'user.user.login',
                ]
            ],
            'logout' => 'user.user.logout',

            // Endpoint User
            'users' => [
                'fnc' => [
                    'get' => 'user.user.list',
                    'post' => 'user.user.list',
                    'put' => 'user.user.update',
                    'delete' => 'user.user.delete'
                ],
                'permission' => [
                    'get' => ['user_manager', 'user_read'],
                    'post' => ['user_manager', 'user_read'],
                    'put' => ['user_manager', 'user_update'],
                    'delete' => ['user_manager', 'user_delete'],
                ],
            ],
            'profile' => [
                'fnc' => [
                    'get' => 'user.user.profile',
                    'post' => 'user.user.saveProfile',
                ],
                'permission' => [
                    'get' => ['user_manager', 'user_profile'],
                    'post' => ['user_manager', 'user_profile'],
                ],
            ],
            'user/0' => [
                'fnc' => [
                    'get' => 'user.user.detail',
                    'post' => 'user.user.add',
                ],
                'permission' => [
                    'get' => ['user_manager', 'user_create'],
                    'post' => ['user_manager', 'user_create'],
                ],
            ],
            'user' => [
                'fnc' => [
                    'get' => 'user.user.detail',
                    'put' => 'user.user.update',
                    'delete' => 'user.user.delete'
                ],
                'parameters' => ['id'],
                'permission' => [
                    'get' => ['user_manager', 'user_update'],
                    'put' => ['user_manager', 'user_update'],
                    'delete' => ['user_manager', 'user_delete']
                ],
            ],
            'user-groups' => [
                'fnc' => [
                    'get' => 'user.usergroup.list',
                    'post' => 'user.usergroup.list',
                    'put' => 'user.usergroup.update',
                    'delete' => 'user.usergroup.delete'
                ],
                'permission' => [
                    'get' => ['usergroup_manager', 'usergroup_read'],
                    'post' => ['usergroup_manager', 'usergroup_read'],
                    'put' => ['usergroup_manager', 'usergroup_update'],
                    'delete' => ['usergroup_manager', 'usergroup_delete']
                ],
            ],

            'user-group/0' => [
                'fnc' => [
                    'get' => 'user.usergroup.detail',
                    'post' => 'user.usergroup.add',
                ],
                'permission' => [
                    'post' => ['usergroup_manager', 'usergroup_create'],
                    'get' => ['usergroup_manager', 'usergroup_create'],
                ],
            ],

            'user-group' => [
                'fnc' => [
                    'get' => 'user.usergroup.detail',
                    'put' => 'user.usergroup.update',
                    'delete' => 'user.usergroup.delete'
                ],
                'parameters' => ['id'],
                'permission' => [
                    'get' => ['usergroup_manager', 'usergroup_update'],
                    'put' => ['usergroup_manager', 'usergroup_update'],
                    'delete' => ['usergroup_manager', 'usergroup_delete']
                ],
            ],
        ];
    }
}
