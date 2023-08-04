<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\page_contact\viewmodels;

use SPT\Web\ViewModel;
use SPT\Web\Gui\Form;

class ContactPage extends ViewModel
{
    public static function register()
    {
        return [
            'layout'=>'contact',
        ];
    }

    public function contact()
    {
        $page = $this->app->get('object', []);
        $message = $this->session->get('flashMsg', '');
        $this->session->set('flashMsg', '');
        
        return [
            'page' => $page,
            'message' => $message,
            'link_submit' => $this->router->url('contact/submit'),
        ];
    }
}
