<?php
namespace App\plugins\note\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Setting
{
    public static function registerSetting( IApp $app )
    {
        $container = $app->getContainer();
        $setting = $container->exists('setting') ? $container->get('setting') : [];
        $arr = [
            [['setting-connections'], 'setting-connections', 'Connections', ''],
        ];
        $container->set('setting', array_merge($setting, $arr));
    }
}