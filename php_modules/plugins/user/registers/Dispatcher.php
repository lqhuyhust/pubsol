<?php
namespace App\plugins\user\registers;

use SPT\Application\IApp;

class Dispatcher
{
    public static function dispatch( IApp $app, string $cName, string $fName)
    {
        $app->loadPlugins('entity', 'loadEntity');
        $app->loadPlugins('user', 'loadUser');
        $app->loadPlugins('middleware', 'AfterRouting');

        $controller = 'App\plugins\user\controllers\\'. $cName;
        if(class_exists($controller))
        {
            $controller = new $controller($app);
            $controller->{$fName}();

            switch($app->get('format', ''))
            {
                default:
                case 'html': $controller->toHtml(); break;
                case 'ajax': $controller->toAjax(); break;
                case 'json': $controller->toJson(); break;
            }
        }
    }
}