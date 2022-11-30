<?php
/**
 * SPT software - Stater plugin
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic plugin
 * 
 */

namespace App\plugins\user;

use SPT\Plugin\CMS as PluginAbstract;

class plugin extends PluginAbstract
{ 
    public function register()
    {
        return [
            // write your code here
            'viewmodels' => [
                'alias' => [
                    'App\plugins\user\viewmodels\AdminUsersVM' => 'AdminUsersVM',
                    'App\plugins\user\viewmodels\AdminUserVM' => 'AdminUserVM',
                ],
            ],
            'models' => [
                'alias' => [
                    'App\plugins\user\models\UserModel' => 'UserModel',
                ],
            ],
            'entity' => [],
            'file' => [],
        ];
    }

    public function getInfo()
    {
        return [
            'name' => 'user',
            'author' => 'Pham Minh',
            'version' =>  '0.1',
            'description' => 'User Plugin'
        ];
    }

    public function loadFile(Container $container)
    {
        $container->set('file', new File());
    }

    public function loadEntity(Container $container)
    {
        $path = AppIns::path('plugin'). 'user/entities';
        $namespace = 'App\plugins\user\entities';
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
            // else { debug this }
        }
    }
}
