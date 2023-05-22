<?php

namespace App\plugins\setting\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'settings'=>[
                'fnc' => [
                    'get' => 'setting.setting.form',
                    'post' => 'setting.setting.save',
                ],
            ],
        ];
    }
}