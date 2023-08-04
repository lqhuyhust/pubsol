<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\page\viewmodels;

use SPT\Web\ViewModel;
use SPT\Web\Gui\Form;

class AdminPageWidget extends ViewModel
{
    public static function register()
    {
        return [
            'widget'=>'backend.popup_new',
        ];
    }

    public function popup_new()
    {
        $types = $this->PageModel->getTypes();
        $page_type = [];
        foreach($types as $type => $t)
        {
            $page_type[] = [
                    'link' => $this->router->url('new-page/'. $type ),
                    'title' => $t['name'] 
                ];
        }

        return [
            'page_type' => $page_type,
        ];
    }
}
