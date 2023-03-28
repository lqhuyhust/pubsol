<?php
namespace App\plugins\user\registers;

use SPT\Application\IApp;
use SPT\Response;

class Dispatcher
{
    public static function dispatch( IApp $app, string $cName, string $fName)
    {
        $app->loadPlugins('entity', 'loadEntity');
        $app->loadPlugins('user', 'loadUser');
        $app->loadPlugins('middleware', 'AfterRouting');

        $controller = 'App\plugins\user\controllers\\'. $cName;
        if(!class_exists($controller))
        {
            throw new \Exception('Invalid controller '. $cName);
        }

        $controller = new $controller($app);
        $controller->{$fName}();
        $format = $app->get('format', 'html');
        $fName = 'to'. ucfirst($format);
        $content = $controller->{$fName}();
        Response::_200($content);
    }
}