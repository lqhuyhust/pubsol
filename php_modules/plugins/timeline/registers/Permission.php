<?php

namespace App\plugins\timeline\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'timeline_manager', 'timeline_view'
        ];
    }

    public static function registerPermission()
    {
        return [
            'timeline' => [
                'get' => ['timeline_manager', 'timeline_view'],
                'post' => ['timeline_manager', 'timeline_view'],
            ],
        ];
    }
}
