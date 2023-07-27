<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\db_tool\models;

use SPT\Container\Client as Base;
use SPT\Support\Loader;

class DbToolModel extends Base
{ 
    use \SPT\Traits\ErrorString;

    public function getEntities()
    {
        $entities = [];
        $container = $this->getContainer();
        $plgList = $this->app->plugin(true);
        
        foreach($plgList as $plg)
        {
            Loader::findClass( 
                $plg['path']. '/entities', 
                $plg['namespace']. '\entities', 
                function($classname, $fullname) use ($container, &$entities)
                {
                    if ($container->exists($classname))
                    {
                        $entities[] = $classname;
                    }
                });
        }

        return $entities;
    }
}
