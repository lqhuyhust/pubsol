<?php

namespace App\plugins\user_assignee\registers;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'user/search' => [
                'fnc' => [
                    'get' => 'user_assignee.ajax.search',
                ],
            ],
        ];
    }
}
