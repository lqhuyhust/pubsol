<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */
namespace App\plugins\core\viewmodels; 

use SPT\Web\MVVM\ViewModel;

class MessageVM extends ViewModel
{
    protected $alias = 'MessageVM';

    public static function register()
    {
        return [
            'layouts.message|render',
            'layouts.notification|render',
        ];
    }

    public function render()
    {
        $message = $this->session->get('flashMsg');
        $message = is_array($message) ? implode('<br>', $message) : $message;
        $this->view->set('message', $message);
        $this->session->set('flashMsg', '');
    }
}
