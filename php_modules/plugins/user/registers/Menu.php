<?php
namespace App\plugins\user\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function register( IApp $app )
    {
        $container = $app->getContainer();
        $menu = $container->get('menu') ?? [];

        $menu_user = [];

        $menu_user = [['users', 'user','user-groups', 'user-group',], 'users', 'Users', '<i class="fa-solid fa-users"></i>', []];
        $menu_user[4][] = [['users', 'user',], 'users', 'Users', '<i class="fa-solid fa-user"></i>', '',];
        $menu_user[4][] = [['user-groups', 'user-group',], 'user-groups', 'Groups', '<i class="fa-solid fa-user-group"></i>', ''];

        $menu_user[] = [['profile'], 'profile', 'Profile', '<i class="fa-solid fa-user"></i>', ''];
        $menu_user[] = [['logout'], 'logout', 'Logout', '<i class="fa-solid fa-right-from-bracket"></i>', ''];

        $menu = array_merge($menu, $menu_user);
        $container->set('menu', $menu);
    }
}