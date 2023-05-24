<?php
namespace App\plugins\tag\registers;

use SPT\Application\IApp; 
use SPT\File;

class Dispatcher
{
    public static function dispatch( IApp $app, string $cName, string $fName)
    {
        // prepare note
        $container = $app->getContainer();
        if (!$container->exists('file'))
        {
            $container->set('file', new File());
        }
        
        $cName = ucfirst($cName);

        $controller = 'App\plugins\tag\controllers\\'. $cName;
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