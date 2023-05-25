<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\setting\models;

use SPT\JDIContainer\Base; 

class SettingModel extends Base 
{ 
    public function getSetting()
    {
        $settings = [];
        $this->app->plgLoad('setting', 'registerItem', function ($arr) use ( &$settings ){
            if (is_array($arr))
            {
                $settings = array_merge($settings, $arr);
            }
        });
        
        return $settings;
    }
}