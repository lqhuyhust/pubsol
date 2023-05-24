<?php
namespace App\plugins\user\registers;

use SPT\Application\IApp;
use SPT\Response;

class Dispatcher
{
    public static function dispatch( IApp $app, string $cName, string $fName)
    {
        if( $cName != 'user' || !in_array($fName, ['gate', 'login']))
        {
            $app->plgLoad('permission', 'CheckSession');
        }

        $cName = ucfirst($cName);
        $controller = 'App\plugins\user\controllers\\'. $cName;
        if(!class_exists($controller))
        {
            $app->raiseError('Invalid controller '. $cName);
        }

        $controller = new $controller($app);
        $controller->{$fName}();

        $fName = 'to'. ucfirst($app->get('format', 'html'));

        $app->finalize(
            $controller->{$fName}()
        );
    }
}