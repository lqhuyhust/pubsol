<?php

namespace App\plugins\setting\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
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
    }
}
