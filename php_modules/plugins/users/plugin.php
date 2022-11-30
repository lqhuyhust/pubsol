<?php
/**
 * SPT software - Core plugin
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace App\plugins\users;

use SPT\App\Instance as AppIns;
use SPT\Support\Loader;
use Joomla\DI\Container;
use SPT\Plugin\CMS as PluginAbstract;
use SPT\File;
use SPT\Middleware\Dispatcher as MW;
use App\plugins\users\middlewares\Permission;
use App\plugins\users\middlewares\Validation;
use SPT\Dispatcher;

class plugin extends PluginAbstract
{ 
    public function register()
    {
        $permissionList = new Permission('plugins\users\middlewares\permission');
        MW::register('permission', $permissionList);

        $Validation = new Validation('plugins\users\middlewares\validation');
        MW::register('validation', $Validation);

        Dispatcher::register('afterNewUser', 'UserGroupModel', 'addUserMap');
        Dispatcher::register('afterUpdateUser', 'UserGroupModel', 'updateUserMap');
        Dispatcher::register('afterRemoveUser', 'UserGroupModel', 'removeByUser');
        Dispatcher::register('afterRemoveGroup', 'UserGroupModel', 'removeByGroup');

        return [
            'models' => [
                'alias' => [
                    'App\plugins\users\models\UserModel' => 'UserModel',
                    'App\plugins\users\models\GroupModel' => 'GroupModel',
                    'App\plugins\users\models\UserGroupModel' => 'UserGroupModel',
                ]
            ],
            'viewmodels' => [
                'alias' => [
                    'App\plugins\users\viewmodels\UsersVM' => 'UsersVM',
                    'App\plugins\users\viewmodels\UserVM' => 'UserVM',
                    'App\plugins\users\viewmodels\GroupsVM' => 'GroupsVM',
                    'App\plugins\users\viewmodels\GroupVM' => 'GroupVM',
                    'App\plugins\users\viewmodels\UsersPaginationVM' => 'UsersPaginationVM',
                ],
            ],
            'entity' => [],
            'file' => []
        ];
    }

    public function info()
    {
        return [
            'author' => 'Pham Minh',
            'version' =>  '0.1',
            'description' => 'User Plugin',
        ];
    }

    public function getRightAccess()
    {
        return ['user_create', 'user_read', 'user_manager','user_delete', 'user_update', 'usergroup_manager', 'usergroup_read', 'usergroup_delete', 'usergroup_update', 'usergroup_create'];
    }

    public function loadFile(Container $container)
    {
        $container->set('file', new File());
    }
    
    public function loadEntity(Container $container)
    {
        $path = AppIns::path('plugin'). 'users/entities';
        $namespace = 'App\plugins\users\entities';
        $inners = Loader::findClass($path, $namespace);
        foreach($inners as $class)
        {
            if(class_exists($class))
            {
                $entity = new $class($container->get('query'));
                $container->share( $class, $entity, true);
                $entity->checkAvailability();
                $alias = explode('\\', $class);
                $container->alias( $alias[count($alias) - 1], $class);
            }
            // else { debug this }
        }
    }

}
