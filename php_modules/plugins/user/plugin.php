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

use SPT\App\Instance as AppIns;
use SPT\Plugin\CMS as PluginAbstract;
use SPT\Support\Loader;
use Joomla\DI\Container;
use SPT\Middleware\Dispatcher as MW;
use App\plugins\user\middlewares\Permission;
use App\plugins\user\middlewares\Validation;
use SPT\File;
use SPT\Dispatcher;

class plugin extends PluginAbstract
{ 
    public function register()
    {
        $Validation = new Validation('plugins\user\middlewares\validation');
        MW::register('validation', $Validation);

        $permissionList = new Permission('plugins\user\middlewares\permission');
        MW::register('permission', $permissionList);

        return [
            // write your code here
            'viewmodels' => [
                'alias' => [
                    'App\plugins\user\viewmodels\AdminUsersVM' => 'AdminUsersVM',
                    'App\plugins\user\viewmodels\AdminUserVM' => 'AdminUserVM',
                    'App\plugins\user\viewmodels\AdminGroupsVM' => 'AdminGroupsVM',
                    'App\plugins\user\viewmodels\AdminGroupVM' => 'AdminGroupVM',
                ],
            ],
            'models' => [
                'alias' => [
                    'App\plugins\user\models\UserModel' => 'UserModel',
                    'App\plugins\user\models\UserGroupModel' => 'UserGroupModel',
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

    public function registerMenu()
    {
        $user = AppIns::factory('user');
        $menu = [];
        $permissionList = $user->getPermissions($user->get('id'));
        $menu_user = [];

        if (in_array('user_manager', $permissionList) || in_array('user_read', $permissionList) || in_array('usergroup_manager', $permissionList) || in_array('usergroup_read', $permissionList))
        {
            $menu_user = [['users', 'user','user-groups', 'user-group',], 'users', 'Users', '<i class="fa-solid fa-users"></i>', []];
            if (in_array('user_manager', $permissionList) || in_array('user_read', $permissionList))
            {
                $menu_user[4][] = [['users', 'user',], 'users', 'Users', '<i class="fa-solid fa-user"></i>', '',];
            }
            if (in_array('usergroup_manager', $permissionList) || in_array('usergroup_read', $permissionList))
            {
                $menu_user[4][] = [['user-groups', 'user-group',], 'user-groups', 'Groups', '<i class="fa-solid fa-user-group"></i>', ''];
            }
        }

        if ($menu_user)
        {
            $menu[] = $menu_user;
        }

        $menu[] = [['profile'], 'profile', 'Profile', '<i class="fa-solid fa-user"></i>', ''];
        $menu[] = [['logout'], 'logout', 'Logout', '<i class="fa-solid fa-right-from-bracket"></i>', ''];
        return $menu;
    }

    public function getRightAccess()
    {
        return ['user_manager', 'user_create', 'user_read', 'user_delete', 'user_update', 'usergroup_manager', 'usergroup_read', 'usergroup_create', 'usergroup_update', 'usergroup_delete'];
    }

}
