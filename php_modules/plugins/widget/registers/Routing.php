<?php
namespace App\plugins\widget\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'widgets' => [
                'fnc' => [
                    'get' => 'widget.ajax.list',
                ],
                'permission' => [ 
                    //..
                ],
            ],
            'widget/update-position' => [
                'fnc' => [
                    'post' => 'widget.ajax.updateposition',
                ],
            ],
        ];
    }
}