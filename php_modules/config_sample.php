<?php  defined('APP_PATH') or die('Invalid config');

return [ 
    'sitepath' => '',
    'plugins' => ['starter'],
    'theme' => 'demo',
    'secrect' => 'sid',
    'endpoints' => [
    ],
    'defaultEndpoint' => [
        'fnc' => 'start.home.home'
    ],
    'db' => [
        'host' => '',
        'username' => '',
        'password' => '',
        'database' => '',
        'prefix' => '',
    ],
];
