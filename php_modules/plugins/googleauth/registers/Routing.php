<?php

namespace App\plugins\googleauth\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'loginGoogle' => [
                'fnc' => [
                    'get' => 'googleAuth.google.login',
                ]
            ],
        ];
    }
}
