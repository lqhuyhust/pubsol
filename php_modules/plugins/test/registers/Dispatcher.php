<?php
namespace App\plugins\test\registers;

use SPT\Application\IApp; 
use SPT\File;

class Dispatcher
{
    public static function dispatch(IApp $app)
    {
        //$app->plgLoad('permission', 'CheckSession'); 
        // prepare note
        $container = $app->getContainer(); 
        
        $cName = $app->get('controller');
        $fName = $app->get('function'); 

        $controller = 'App\plugins\test\controllers\\'. $cName;
        if(!class_exists($controller))
        {
            $app->raiseError('Invalid controller '. $cName);
        }
        
        // set plugin info 

        $controller = new $controller($app->getContainer());
        $controller->{$fName}();
        $controller->setCurrentPlugin();
        $controller->useDefaultTheme();

        $fName = 'to'. ucfirst($app->get('format', 'html'));

        // theme
        if(empty( $app->get('theme', '') ))
        {
            $app->set('theme', $app->cf('defaultTheme'));
        }
        
        $app->finalize(
            $controller->{$fName}()
        );
    }
}