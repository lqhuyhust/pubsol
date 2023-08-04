<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\page_html\viewmodels;

use SPT\Web\ViewModel;
use SPT\Web\Gui\Form;

class HtmlPage extends ViewModel
{
    public static function register()
    {
        return [
            'layout'=>'html',
        ];
    }

    public function html()
    {
        $page = $this->app->get('object', []);
        
        return [
            'page' => $page,
        ];
    }
}
