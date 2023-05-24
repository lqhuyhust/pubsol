<?php
namespace App\plugins\treediagram\registers;

use SPT\Application\IApp;
use Joomla\DI\Container;

class Dispatcher
{
    public static function dispatch( IApp $app, string $cName, string $fName)
    {   
        // Check Permission
        $app->plgLoad('permission', 'CheckSession');

        static::registerEntities($app->getContainer());

        $cName = ucfirst($cName);

        $controller = 'App\plugins\treediagram\controllers\\'. $cName;
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

    private static function registerEntities(Container $container)
    {
        $query = $container->get('query');

        $e = new \App\plugins\treediagram\entities\TreeDiagramEntity($query);
        $e->checkAvailability();
        $container->share( 'TreeDiagramEntity', $e, true);

        $container->share( 'TreeDiagramModel', new \App\plugins\treediagram\models\TreeDiagramModel($container), true);
    }
}