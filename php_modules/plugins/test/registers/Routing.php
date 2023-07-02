<?php
namespace App\plugins\test\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        // TODO: should register home follow configuration and add it here
        // NOW: we set default home here
        return [
            'test' => [
                'fnc' => 'test.demo.test',
                'parameters' => ['slug']
            ],
            // TEMPLATE
            'templates' => [
                'fnc' => [
                    'get' => 'test.template.list',
                    'post' => 'test.template.list',
                    'put' => 'test.template.update',
                    'delete' => 'test.template.delete'
                ],
                'permission' => [ 
                    //..
                ],
            ],
            'template/search' => [
                'fnc' => [
                    'get' => 'test.template.search',
                ],
            ],
            'template' => [
                'fnc' => [
                    'get' => 'test.template.detail',
                    'post' => 'test.template.add',
                    'put' => 'test.template.update',
                    'delete' => 'test.template.delete'
                ],
                'parameters' => ['id'],
                'permission' => [ 
                    // ..
                ],
            ],
            // PAGE
            'pages' => [
                'fnc' => [
                    'get' => 'test.page.list',
                    'post' => 'test.page.list',
                    'put' => 'test.page.update',
                    'delete' => 'test.page.delete'
                ],
                'permission' => [ 
                    //..
                ],
            ],
            'page/search' => [
                'fnc' => [
                    'get' => 'test.page.search',
                ],
            ],
            'page' => [
                'fnc' => [
                    'get' => 'test.page.detail',
                    'post' => 'test.page.add',
                    'put' => 'test.page.update',
                    'delete' => 'test.page.delete'
                ],
                'parameters' => ['id'],
                'permission' => [ 
                    // ..
                ],
            ],
        ];
    }
}