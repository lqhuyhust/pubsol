<?php 

return [
    'home' => [
        'fnc' => 'setting.home.home',
    ],
    'login' => [
        'fnc' => [
            'get' => 'setting.home.gate',
            'post' => 'setting.home.login',
        ]
    ],
    
    'logout' => 'setting.home.logout',
    '/admin' => 'setting.subject.list',
    'admin' => [
        
        'setting'=>[
            'fnc' => [
                'get' => 'setting.setting.form',
                'post' => 'setting.setting.save',
            ],
        ],
        'login' => [
            'fnc' => [
                'get' => 'setting.admin.gate',
                'post' => 'setting.admin.login',
            ]
        ],
        'logout' => 'setting.admin.logout',
        'renew-special' => [
            'fnc' => [
                'post' => 'setting.user.renew',
            ]
        ],
        // 'topics' => 'facts4me.admin.list_topic',
        // 'form_topic' => 'facts4me.admin.form_topic',
        // 'users' => 'facts4me.admin.list_user',
        // 'form_user' => 'facts4me.admin.form_user',
        // 'subjects' => 'facts4me.admin.list_subject',
        // 'form_subject' => 'facts4me.admin.form_subject',
        // 'login' => 'facts4me.admin.login',
    ],
];
