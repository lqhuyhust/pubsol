<?php 

return [
    '/admin' => [
        'login' => [
            'fnc' => [
                'get' => 'users.user.gate',
                'post' => 'users.user.login',
            ]
        ],
        'logout' =>'users.user.logout',

        // Endpoint User
        'userAdd' => [
            'fnc' => 'users.user.detail',
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['user_manager', 'user_create'],
                ],
            ],
        ],
        'userAddSave' => [
            'fnc' => [
                'post' => 'users.user.add',
            ],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['user_manager', 'user_create'],
                ],
                'validation' => [
                    'ValidateToken' => '',
                ],
            ],
        ],
        'userUpdate' => [
            'fnc' => 'users.user.detail',
            'parameters' => ['id'],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['user_manager', 'user_update'],
                ],
            ],
        ],
        'userUpdateSave' => [
            'fnc' => [
                'put' => 'users.user.update',
            ],
            'parameters' => ['id'],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['user_manager', 'user_update'],
                ],
                'validation' => [
                    'ValidateToken' => '',
                ],
            ],
        ],
        'userDelete' => [
            'fnc' => [
                'delete' => 'users.user.delete',
            ],
            'parameters' => ['id'],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['user_manager', 'user_delete'],
                ],
                'validation' => [
                    'ValidateToken' => '',
                ],
            ],
        ],
        'users'=>[
            'fnc' => [
                'get' => 'users.user.list',
                'post' => 'users.user.list',
            ],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['user_manager', 'user_read'],
                ],
            ],
        ],
        'usersUpdate' => [
            'fnc' => [
                'put' => 'users.user.update', 
            ],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['user_manager', 'user_update'],
                ],
                'validation' => [
                    'ValidateToken' => '',
                ]
            ],
        ],
        'usersDelete' => [
            'fnc' => [
                'delete' => 'users.user.delete'
            ],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['user_manager', 'user_delete'],
                ],
                'validation' => [
                    'ValidateToken' => '',
                ]
            ],
        ],

        // Endpoint User Group
        'userGroupAdd' => [
            'fnc' => 'users.userGroup.detail',
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['usergroup_manager', 'usergroup_create'],
                ],
            ],
        ],
        'userGroupAddSave' => [
            'fnc' => [
                'post' => 'users.userGroup.add',
            ],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['usergroup_manager', 'usergroup_create'],
                ],
                'validation' => [
                    'ValidateToken' => '',
                ]
            ],
        ],
        'userGroupUpdate' => [
            'fnc' => 'users.userGroup.detail',
            'parameters' => ['id'],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['usergroup_manager', 'usergroup_update'],
                ],
            ],
        ],
        'userGroupUpdateSave' => [
            'fnc' => [
                'put' => 'users.userGroup.update',
            ],
            'parameters' => ['id'],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['usergroup_manager', 'usergroup_update'],
                ],
                'validation' => [
                    'ValidateToken' => '',
                ]
            ],
        ],
        'userGroupDelete' => [
            'fnc' => [
                'delete' => 'users.userGroup.delete'
            ],
            'parameters' => ['id'],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['usergroup_manager', 'usergroup_delete'],
                ],
                'validation' => [
                    'ValidateToken' => '',
                ]
            ],
        ],
        'userGroups'=>[
            'fnc' => [
                'get' => 'users.userGroup.list',
                'post' => 'users.userGroup.list',
            ],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['usergroup_manager', 'usergroup_read'],
                ],
            ],
        ],
        'userGroupsUpdate'=>[
            'fnc' => [
                'put' => 'users.userGroup.update', 
            ],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['usergroup_manager', 'usergroup_read'],
                ],
                'validation' => [
                    'ValidateToken' => '',
                ]
            ],
        ],
        'userGroupsDelete'=>[
            'fnc' => [
                'delete' => 'users.userGroup.delete'
            ],
            'middleware' => [
                'permission' => [
                    'PermissionKey' => ['usergroup_manager', 'usergroup_read'],
                ],
                'validation' => [
                    'ValidateToken' => '',
                ]
            ],
        ],
    ],
    'admin' => [
        'fnc' => 'users.user.list',
        'middleware' => [
            'permission' => [
                'PermissionKey' => ['user_manager', 'user_read'],
            ],
        ],
    ],
];
