<?php

namespace App\plugins\db_tool\registers;

use SPT\Application\IApp;

class Cli
{
    public static function registerCommands()
    {
        return [
            'checkavailability' => [
                'description' => 'Check availability database',
                'fnc' => 'db_tool.database.checkavailability'
            ]
        ];
    }
}
