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

use SPT\View\VM\JDIContainer\ViewModel; 

class MessageVM extends ViewModel
{
    protected $alias = 'MessageVM';
    protected $layouts = ['layouts.message|render'];

    public function render()
    {
        $this->view->set('message', $this->session->get('flashMsg'));
        $this->session->set('flashMsg', '');
    }
}
