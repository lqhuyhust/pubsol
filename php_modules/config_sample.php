<?php  defined('APP_PATH') or die('Invalid config');

return [ 
    'sitepath' => '',
    'plugins' => ['milestone', 'note', 'version', 'setting', 'user'],
    'theme' => 'sdm',
    'secrect' => 'sid',
    'endpoints' => [
    ],
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
    'extension_allow' => ['png', 'jpg', 'jpeg', 'pdf', 'txt', 'doc', 'docx', 'xlsx'],
    'redirect_after_login' => 'milestones',
];
