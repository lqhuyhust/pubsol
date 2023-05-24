<?php
namespace App\plugins\treephp\registers;

use SPT\Application\IApp;
use Joomla\DI\Container;

class Dispatcher
{
    public static function dispatch( IApp $app, string $cName, string $fName)
    {
        // static::registerEntities($app->getContainer());

        $cName = ucfirst($cName);

        $controller = 'App\plugins\treephp\controllers\\'. $cName;
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
        $e = new \App\plugins\treephp\entities\TreeStructureEntity($query);
        $e->checkAvailability();
        $container->share( 'TreeStructureEntity', $e, true);

        $e = new \App\plugins\treephp\entities\DiagramEntity($query);
        $e->checkAvailability();
        $container->share( 'DiagramEntity', $e, true);

        $container->share( 'TreePhpModel', new \App\plugins\treephp\models\TreePhpModel($container), true);
    }
}