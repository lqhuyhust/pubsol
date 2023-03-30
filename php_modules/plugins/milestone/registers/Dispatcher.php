<?php
namespace App\plugins\milestone\registers;

use SPT\Application\IApp;
use SPT\Response;

class Dispatcher
{
    public static function dispatch( IApp $app, string $cName, string $fName)
    {
        $app->loadPlugins('entity', 'loadEntity');
        $app->loadPlugins('user', 'loadUser');
        $app->loadPlugins('model', 'loadModel');
        $app->loadPlugins('middleware', 'AfterRouting');

        $controller = 'App\plugins\milestone\controllers\\'. $cName;
        if(!class_exists($controller))
        {
            throw new \Exception('Invalid controller '. $cName);
        }

        $controller = new $controller($app);
        $controller->{$fName}();
        $format = $app->get('format', 'html');
        if ($format != 'json')
        {
            $controller->set('url', $app->url());
        }
        $fName = 'to'. ucfirst($format);
        $content = $controller->{$fName}();
        Response::_200($content);
    }
}