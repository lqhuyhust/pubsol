<?php
namespace App\plugins\user\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerMenu( IApp $app )
    {
        $container = $app->getContainer();
        $menu_root = $container->exists('menu') ? $container->get('menu') : [];

        $menu = [];
        $permission = $container->get('permission');
        $allow_user = true;
        $allow_usergroup = true;
        if ($permission)
        {
            $allow_user = $permission->checkPermission(['user_manager', 'user_read']);
            $allow_usergroup = $permission->checkPermission(['usergroup_manager', 'usergroup_read']);
        }
        $menu_user = [];
        if ($allow_user || $allow_usergroup)
        {
            $menu_user = [['users', 'user','user-groups', 'user-group',], 'users', 'Users', '<i class="fa-solid fa-users"></i>', []];
        }
        if ($allow_user)
        {
            $menu_user[4][] = [['users', 'user',], 'users', 'Users', '<i class="fa-solid fa-user"></i>', '',];
        }
        if ($allow_usergroup)
        {
            $menu_user[4][] = [['user-groups', 'user-group',], 'user-groups', 'Groups', '<i class="fa-solid fa-user-group"></i>', ''];
        }

        if ($menu_user)
        {
            $menu[] = $menu_user;
        }
        $menu[] = [['profile'], 'profile', 'Profile', '<i class="fa-solid fa-user"></i>', ''];
        $menu[] = [['logout'], 'logout', 'Logout', '<i class="fa-solid fa-right-from-bracket"></i>', ''];

        $menu_root[15] = isset($menu_root[15]) ? array_merge($menu_root[15], $menu) : $menu;
        $container->set('menu', $menu_root);
    }
}