<?php
namespace App\plugins\version\registers;

use SPT\Application\IApp;
use SPT\Response;

class Dispatcher
{
    public static function dispatch( IApp $app, string $cName, string $fName)
    {
        $app->loadPlugins('entity', 'loadEntity');
        $app->loadPlugins('user', 'loadUser');
        $app->loadPlugins('menu', 'registerMenu');
        $app->loadPlugins('middleware', 'AfterRouting');

        $controller = 'App\plugins\version\controllers\\'. $cName;
        if(!class_exists($controller))
        {
            throw new \Exception('Invalid controller '. $cName);
        }

        $controller = new $controller($app);
        $controller->set('url', $app->url());
        $controller->{$fName}();
        $format = $app->get('format', 'html');
        $fName = 'to'. ucfirst($format);
        $content = $controller->{$fName}();
        Response::_200($content);
    }
}