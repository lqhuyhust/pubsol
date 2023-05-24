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
                ],
                'permission' => [
                    'get' => ['timeline_manager', 'timeline_read'],
                    'post' => ['timeline_manager', 'timeline_read'],
                ],
            ],
        ];
    }
}
