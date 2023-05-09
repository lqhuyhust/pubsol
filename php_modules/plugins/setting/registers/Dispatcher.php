<?php
namespace App\plugins\setting\registers;

use SPT\Application\IApp;
use SPT\Response;

class Dispatcher
{
    public static function dispatch( IApp $app, string $cName, string $fName)
    {
        $app->plgLoad('entity', 'loadEntity');
        $app->plgLoad('user', 'loadUser');
        $app->plgLoad('model', 'loadModel');
        $app->plgLoad('middleware', 'AfterRouting');

        $cName = ucfirst($cName);
        $controller = 'App\plugins\setting\controllers\\'. $cName;
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