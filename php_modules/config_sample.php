<?php  defined('APP_PATH') or die('Invalid config');

return [ 
    'sitepath' => '',
    'plugins' => ['user', 'setting', 'milestone'],
    'theme' => 'sdm',
    'secrect' => 'sid',
    'endpoints' => [
    ],
    'defaultEndpoint' => [
        'fnc' => 'user.user.list'
    ],
    'db' => [
        'host' => '',
        'username' => '',
        'password' => '',
        'database' => '',
        'prefix' => '',
    ],
];
