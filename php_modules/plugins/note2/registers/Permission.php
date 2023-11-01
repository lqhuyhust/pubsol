<?php

namespace App\plugins\note2\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'note_manager'
        ];
    }
}
