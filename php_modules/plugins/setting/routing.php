<?php 

return [
    
    // '' => 'setting.home.home',
    'setting-system'=>[
        'fnc' => [
            'get' => 'setting.setting.system',
            'post' => 'setting.setting.systemSave',
        ],
    ],
    'setting-smtp'=>[
        'fnc' => [
            'get' => 'setting.setting.smtp',
            'post' => 'setting.setting.smtpSave',
        ],
    ],
    'setting/mail-test'=>[
        'fnc' => [
            'post' => 'setting.setting.testMail',
        ],
    ],
];
