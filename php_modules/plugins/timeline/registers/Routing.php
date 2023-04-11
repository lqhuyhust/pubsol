<?php

namespace App\plugins\timeline\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'timeline' => [
                'fnc' => [
                    'get' => 'timeline.timeline.diagram',
                    'post' => 'timeline.timeline.diagram',
                ]
            ],
        ];
    }
}
