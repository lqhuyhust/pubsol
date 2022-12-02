<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */
namespace App\plugins\starter\viewmodels; 

use SPT\View\VM\JDIContainer\ViewModel; 

class HomeVM extends ViewModel
{
    protected $alias = '';
    protected $layouts = [
        'layouts.home'
    ];

    // write your code here

    public function home()
    {
        $this->set('url', $this->router->url(), true);
    }
}
