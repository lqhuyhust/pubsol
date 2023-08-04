<?php
namespace App\plugins\template\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            // TEMPLATE 
            'templates' => [
                'fnc' => [
                    'get' => 'template.template.list',
                    'post' => 'template.template.list',
                    'put' => 'template.template.update',
                    'delete' => 'template.template.delete'
                ],
                'permission' => [ 
                    //..
                ],
            ],
            'template/load-widget' => [
                'fnc' => [
                    'get' => 'template.template.loadWidget',
                ],
                'parameters' => ['id'],
            ],
            'template/search' => [
                'fnc' => [
                    'get' => 'template.template.search',
                ],
            ],
            'template' => [
                'fnc' => [
                    'get' => 'template.template.detail',
                    'post' => 'template.template.add',
                    'put' => 'template.template.update',
                    'delete' => 'template.template.delete'
                ],
                'parameters' => ['id'],
                'permission' => [ 
                    // ..
                ],
            ],
        ];
    }
}