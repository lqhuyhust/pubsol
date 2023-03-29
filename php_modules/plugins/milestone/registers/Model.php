<?php
namespace App\plugins\milestone\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Model
{
    public static function LoadModel( IApp $app )
    {
        $container = $app->getContainer();
        $path = $app->getPluginPath().'milestone/models';
        $namespace = $app->getNamespace().'\plugins\milestone\models';
        $inners = Loader::findClass($path, $namespace);
        foreach($inners as $class)
        {
            if(class_exists($class))
            {
                $model = new $class($container);
                $alias = explode('\\', $class);
                $container->share( $alias[count($alias) - 1], $model, true);
            }
        }
    }
}