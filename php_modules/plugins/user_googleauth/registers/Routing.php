<?php

namespace App\plugins\user_googleauth\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'loginGoogle' => [
                'fnc' => [
                    'get' => 'user_googleAuth.google.login',
                ]
            ],
        ];
    }
}
