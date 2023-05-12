<?php

namespace App\plugins\calendar\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'calendar_manager', 'calendar_view'
        ];
    }

    public static function registerPermission()
    {
        return [
            'calendar' => [
                'get' => ['calendar_manager', 'calendar_view'],
                'post' => ['calendar_manager', 'calendar_view'],
            ],
        ];
    }
}
