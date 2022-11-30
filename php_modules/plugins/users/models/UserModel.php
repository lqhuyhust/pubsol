<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */
namespace App\plugins\users\models;
use SPT\JDIContainer\Base;

class UserModel extends Base
{

    public function getRightAccess()
    {
        $key = [];
        $plugins = ['core'];
    
        if($this->config->exists('plugins'))
        {
            $plugins = array_merge($plugins, $this->config->plugins);
        }

        foreach($plugins as $plugin)
        {
            $right_access = [];
            if (method_exists($this->plugin->$plugin, 'getRightAccess'))
            {
                $right_access = $this->plugin->$plugin->getRightAccess();
            }

            if (is_array($right_access) && $right_access)
            {
                $key = array_merge($right_access, $key);
            }
        }

        return $key;
    }

}