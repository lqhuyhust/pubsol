<?php
namespace App\plugins\version\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Setting
{
    public static function registerSetting( IApp $app )
    {
        $container = $app->getContainer();
        $setting = $container->exists('setting') ? $container->get('setting') : [];
        $arr = [
            [['setting-version'], 'setting-version', 'Version', ''],
        ];
        $container->set('setting', array_merge($setting, $arr));
    }
}