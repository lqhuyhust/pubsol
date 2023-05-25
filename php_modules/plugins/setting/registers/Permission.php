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
}
