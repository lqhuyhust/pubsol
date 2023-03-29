<?php
namespace App\plugins\setting\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerMenu( IApp $app )
    {
        $container = $app->getContainer();
        $menu = $container->exists('menu') ? $container->get('menu') : [];

        $app->loadPlugins('setting', 'registerSetting');
        $menu_setting = [];
        if ($container->exists('setting'))
        {
            $setting = $container->get('setting');
            $menu_setting = is_array($setting) ? $setting : [];
        }
        $menu_setting  = array_merge($menu_setting, [
            [['setting-system'], 'setting-system', 'System', ''],
            [['setting-smtp'], 'setting-smtp', 'SMTP', ''],
        ]);
        $menu[] = [['setting', 'setting',], 'setting', 'Settings', '<i class="fa-solid fa-gear"></i>', $menu_setting];

        $container->set('menu', $menu);
    }
}