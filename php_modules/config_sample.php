<?php  defined('APP_PATH') or die('Invalid config');

return [ 
    'subpath' => '',
    'defaultTheme' => 'blue',
    'adminTheme' => 'admin',
    'secrect' => 'sid',
    'expireSessionDuration' => 60,
    'homeEndpoint' => [
        'fnc' => [
            'get' => 'milestone.milestone.list'
        ],
    ],
    'db' => [
        'host' => '',
        'username' => '',
        'password' => '',
        'database' => '',
        'prefix' => '',
    ],
    'db_test' => [
        'host' => '192.168.56.11',
        'username' => 'root',
        'password' => '123123',
        'database' => 'sdm_test', 
        'prefix' => '',
    ],
    'redirectAfterLogin' => 'milestones',
];
