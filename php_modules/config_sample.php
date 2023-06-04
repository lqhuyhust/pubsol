<?php  defined('APP_PATH') or die('Invalid config');

return [ 
    'subpath' => '',
    'defaultTheme' => 'sdm',
    'secrect' => 'sid',
    'defaultEndpoint' => [
        'fnc' => 'milestone.milestone.list'
    ],
    'db' => [
        'host' => '',
        'username' => '',
        'password' => '',
        'database' => '',
        'prefix' => '',
    ],
    'extensionAllow' => ['png', 'jpg', 'jpeg', 'pdf', 'txt', 'doc', 'docx', 'xlsx'],
    'redirectAfterLogin' => 'milestones',
];
