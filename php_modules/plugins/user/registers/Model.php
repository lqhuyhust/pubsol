<?php
namespace App\plugins\user\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Model
{
    public static function LoadModel( IApp $app )
    {
        $container = $app->getContainer();
        $path = $app->getPluginPath().'user/models';
        $namespace = $app->getNamespace().'\plugins\user\models';
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