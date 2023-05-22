<?php

namespace App\plugins\report\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'report_manager', 'report_read'
        ];
    }

    public static function registerPermission()
    {
        return [
            'calendar' => [
                'get' => ['calendar_manager', 'calendar_read'],
                'post' => ['calendar_manager', 'calendar_read'],
            ],
        ];
    }
}
