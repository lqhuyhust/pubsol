<?php
namespace App\plugins\core\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Model
{
    public static function LoadModel( IApp $app )
    {
        $container = $app->getContainer();
        foreach(new \DirectoryIterator($app->getPluginPath()) as $item) 
        {
            if (!$item->isDot() && $item->isDir()) 
            { 
                $path = $app->getPluginPath().$item->getBasename().'/models';
                $namespace = $app->getNamespace().'\\plugins\\'.$item->getBasename().'\models';
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
        
    }
}