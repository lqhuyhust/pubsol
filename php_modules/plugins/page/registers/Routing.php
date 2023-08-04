<?php
namespace App\plugins\page\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
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