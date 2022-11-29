<?php  defined('APP_PATH') or die('Invalid config');

return [ 
    'sitepath' => '',
    'plugins' => ['facts4me'],
    'theme' => 'facts4me',
    'secrect' => 'sid',
    'endpoints' => [
    ],
    'defaultEndpoint' => [
        'fnc' => 'facts4me.home.home'
    ],
    'db' => [
        'host' => '192.168.56.10',
        'username' => 'root',
        'passwd' => '123123',
        'database' => 'facts4me',
        'prefix' => '',
        'options' => '',
        'debug' => true
    ],
    
    'send_host' => 'smtp.gmail.com',
    'send_username' => '',
    'send_password' => '',
    // 'to_addr' => "joe@joeb648.net",
    'to_addr' => "smpdebug1@gmail.com",
];
