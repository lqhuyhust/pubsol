<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\widget\viewmodels;

use SPT\Web\ViewModel;
use SPT\Web\Gui\Form;

class AdminWidget extends ViewModel
{
    public static function register()
    {
        return [
            'widget'=> [
                'backend.select_widget',
                'backend.javascript',
            ]
        ];
    }

    public function select_widget()
    {
        return [];
    }
    
    public function javascript()
    {
        return [
            'link_widgets' => $this->router->url('widgets'),
        ];
        
    }
}
