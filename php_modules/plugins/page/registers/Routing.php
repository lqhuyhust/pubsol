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
            'new-page' => [
                'fnc' => [
                    'get' => 'page.page.newform',
                    'post' => 'page.page.add',
                ],
                'parameters' => ['type'],
                'permission' => [ 
                    // ..
                ],
                'loadChildPluginType' => true,
            ],
            'page/detail' => [
                'fnc' => [
                    'get' => 'page.page.detail',
                    'put' => 'page.page.update',
                ],
                'parameters' => ['id'],
                'permission' => [ 
                    // ..
                ],
                'loadChildPluginType' => true,
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