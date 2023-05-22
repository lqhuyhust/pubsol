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
            'settings'=>[
                'get' => ['setting_manager'],
                'post' => ['setting_manager'],
            ],
        ];
    }
}
