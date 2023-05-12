<?php
namespace App\plugins\user\registers;

use SPT\Application\IApp;
use SPT\Response;

class Dispatcher
{
    public static function dispatch( IApp $app, string $cName, string $fName)
    {
        // fix 
        $container = $app->getContainer();
        if ($container->exists('permission'))
        {
            $allow = $container->get('permission')->checkPermission();
            if (!$allow)
            {
                $router = $container->get('router');
                $session = $container->get('session');
                $session->set('flashMsg', 'You don\'t have permission!');
                $app->redirect($router->url(''));
            }
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