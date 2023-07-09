<?php  defined('APP_PATH') or die('Invalid config');

return [ 
    'subpath' => '',
    'defaultTheme' => 'blue',
    'adminTheme' => 'admin',
    'secrect' => 'sid', 
    'expireSessionDuration' => 60,
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
