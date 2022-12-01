<?php 

return [
    'admin' => [
        'login' => [
            'fnc' => [
                'get' => 'user.user.gate',
                'post' => 'user.user.login',
            ]
        ],
        'logout' =>'user.user.logout',

        // Endpoint User
        'users'=>[
            'fnc' => [
                'get' => 'user.user.list',
                'post' => 'user.user.list',
                'put' => 'user.user.update',
                'delete' => 'user.user.delete'
            ],
        ],
        'user' => [
            'fnc' => [
                'get' => 'user.user.detail',
                'post' => 'user.user.add',
                'put' => 'user.user.update',
                'delete' => 'user.user.delete'
            ],
            'parameters' => ['id'],
        ],
    ],
    '/admin' => [
        'fnc' => 'user.user.list',
    ],
];
