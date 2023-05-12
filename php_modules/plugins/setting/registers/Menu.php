<?php
namespace App\plugins\setting\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerMenu( IApp $app )
    {
        $container = $app->getContainer();
        $menu_root = $container->exists('menu') ? $container->get('menu') : [];
        $permission = $container->exists('permission') ? $container->get('permission') : null;
        $allow = $permission ? $permission->checkPermission(['setting_manager']) : true;
        if (!$allow)
        {
            return false;
        }

        $app->plgLoad('setting', 'registerSetting');
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

        $menu_root[10] = isset($menu_root[10]) ? array_merge($menu_root[10], $menu) : $menu;
        $container->set('menu', $menu_root);
    }
}