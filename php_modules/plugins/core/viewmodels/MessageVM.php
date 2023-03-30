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
        $session = $this->container->get('session');
        $message = $session->get('flashMsg', '');
        $message = is_array($message) ? implode('<br>', $message) : $message;
        $session->set('flashMsg', '');
        return [
            'message' => $message,
        ];
    }
}
