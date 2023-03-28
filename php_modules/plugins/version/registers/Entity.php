<?php
namespace App\plugins\version\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Entity
{
    public static function loadEntity( IApp $app )
    {
        $container = $app->getContainer();
        $path = $app->getPluginPath().'note/entities';
        $namespace = $app->getNamespace().'\plugins\version\entities';
        $inners = Loader::findClass($path, $namespace);
        foreach($inners as $class)
        {
            if(class_exists($class))
            {
                $entity = new $class($container->get('query'));
                $entity->checkAvailability();
                $container->share( $class, $entity, true);
                $alias = explode('\\', $class);
                $container->alias( $alias[count($alias) - 1], $class);
            }
        }
    }
}