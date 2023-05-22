<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace App\plugins\setting\controllers;

use SPT\Web\MVVM\ControllerContainer as Controller;
use SPT\Response;

class Setting extends Controller
{
    public function form()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.setting.form');
        $this->app->set('page', 'backend');
    }

    public function save()
    {
        $settings = [];
        $this->app->plgLoad('setting', 'registerItem', function ($arr) use ( &$settings ){
            if (is_array($arr))
            {
                $settings = array_merge($settings, $arr);
            }
        });
        
        $try = true;
        foreach($settings as $fields)
        {
            if ($fields)
            {
                foreach($fields as $key => $config)
                {
                    $value = $this->request->post->get($key, '', 'string');
                    $value = $value ? $value : '';
                    $try = $this->OptionModel->set($key, $value);
                }
            }
        }

        $msg = $try ? 'Update Successfully' : 'Update Fail';
        $this->session->set('flashMsg', $msg);

        return $this->app->redirect( $this->router->url('settings'));
    }
}