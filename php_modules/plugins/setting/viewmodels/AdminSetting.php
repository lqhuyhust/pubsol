<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\setting\viewmodels;

use SPT\Web\MVVM\ViewModel;
use SPT\View\Gui\Form;

class AdminSetting extends ViewModel
{
    public static function register()
    {
        return [
            'layouts.backend.setting.form',
        ];
    }

    public function form()
    {
        $OptionModel = $this->container->get('OptionModel');

        $app = $this->container->get('app');
        $router = $this->container->get('router');
        $settings = [];
        $app->plgLoad('setting', 'registerItem', function ($arr) use ( &$settings ){
            if (is_array($arr))
            {
                $settings = array_merge($settings, $arr);
            }
        });

        $fields = [];
        foreach($settings as $item)
        {
            if (is_array($item))
            {
                $fields = array_merge($fields, $item);
            }
        }

        $data = [];
        foreach ($fields as $key => $value) {
            if ($key != 'token') {
                $data[$key] =  $OptionModel->get($key, '');
            }
        }
        $form = new Form($fields, $data);
        $button_header = '<button class="btn btn-outline-success btn_apply">
                            Apply
                        </button>
                        <a href="'. $router->url('settings') .'" class="btn ms-2 btn-outline-secondary">
                            Cancel
                        </a>';
        return [
            'fields' => $fields,
            'form' => $form,
            'button_header' => $button_header,
            'settings' => $settings,
            'title_page' => 'Setting',
            'data' => $data,
            'url' => $router->url(),
            'link_form' => $router->url('settings'),
        ];
    }
    
}