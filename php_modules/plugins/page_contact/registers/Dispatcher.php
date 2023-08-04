<?php
namespace App\plugins\page_contact\registers;

use SPT\Application\IApp;
use SPT\Response;

class Dispatcher
{
    public static function dispatch(IApp $app)
    {   
        // Check Permission
        $cName = $app->get('controller');
        $fName = $app->get('function');

        $app->set('theme', $app->cf('adminTheme'));

        $controller = 'App\plugins\page_contact\controllers\\'. $cName;
        if(!class_exists($controller))
        {
            $app->raiseError('Invalid controller '. $cName);
        }

        $controller = new $controller($app->getContainer());
        $controller->{$fName}();
        
        

        $fName = 'to'. ucfirst($app->get('format', 'html'));

        $app->finalize(
            $controller->{$fName}()
        );
    }
}