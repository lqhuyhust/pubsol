<?php

namespace App\plugins\setting\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'setting_manager',
        ];
    }

    public static function registerPermission()
    {
        return [
            'setting-system'=>[
                'get' => ['setting_manager'],
                'post' => ['setting_manager'],
            ],
            'setting-smtp'=>[
                'get' => ['setting_manager'],
                'post' => ['setting_manager'],
            ],
            'setting/mail-test'=>[
                'post' => ['setting_manager'],
            ],
        ];
    }
}
