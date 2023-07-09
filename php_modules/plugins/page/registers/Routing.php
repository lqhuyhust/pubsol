<?php
namespace App\plugins\page\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            // TEMPLATE 
            'templates' => [
                'fnc' => [
                    'get' => 'page.template.list',
                    'post' => 'page.template.list',
                    'put' => 'page.template.update',
                    'delete' => 'page.template.delete'
                ],
                'permission' => [ 
                    //..
                ],
            ],
            'template/load-widget' => [
                'fnc' => [
                    'get' => 'page.template.loadWidget',
                ],
                'parameters' => ['id'],
            ],
            'template/search' => [
                'fnc' => [
                    'get' => 'page.template.search',
                ],
            ],
            'template' => [
                'fnc' => [
                    'get' => 'page.template.detail',
                    'post' => 'page.template.add',
                    'put' => 'page.template.update',
                    'delete' => 'page.template.delete'
                ],
                'parameters' => ['id'],
                'permission' => [ 
                    // ..
                ],
            ],
            // PAGE
            'pages' => [
                'fnc' => [
                    'get' => 'page.page.list',
                    'post' => 'page.page.list',
                    'put' => 'page.page.update',
                    'delete' => 'page.page.delete'
                ],
                'permission' => [ 
                    //..
                ],
            ],
            'page/search' => [
                'fnc' => [
                    'get' => 'page.page.search',
                ],
            ],
            'page' => [
                'fnc' => [
                    'get' => 'page.page.detail',
                    'post' => 'page.page.add',
                    'put' => 'page.page.update',
                    'delete' => 'page.page.delete'
                ],
                'parameters' => ['id'],
                'permission' => [ 
                    // ..
                ],
            ],
        ];
    }

    public static function afterRouting(IApp $app)
    {
        $container = $app->getContainer();
        
        $router = $container->get('router');
        $arr = $router->get('sitemap', []);
        $arr = array_merge($arr, [
            '/' => [
                'fnc' => [
                    'get' => 'page.page.render'
                ],
                'parameters' => ['slug'],
                'loadChildPlugin' => true,
            ],
        ]);
        $router->set('sitemap', $arr);
    }
}