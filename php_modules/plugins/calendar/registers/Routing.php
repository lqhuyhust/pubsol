<?php

namespace App\plugins\calendar\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'calendar' => [
                'fnc' => [
                    'get' => 'calendar.calendar.diagram',
                    'post' => 'calendar.calendar.diagram',
                ]
            ],
        ];
    }
}
