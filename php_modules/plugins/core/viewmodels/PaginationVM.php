<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\core\viewmodels;  

use SPT\Web\MVVM\ViewModel;

class PaginationVM extends ViewModel
{
    protected $alias = 'PaginationVM';

    public static function register()
    {
        return ['layouts.pagination'];
    }

    public function pagination()
    {
        $total = 0;
        if( $this->view->exists('list') )
        {
            $total = $this->view->list->getTotal();

            $this->set('page', $this->request->get->get('page', 1));
            $this->set('totalPage', $this->view->list->getTotalPage());
            $this->set('limit', $this->view->list->getLimit());
            $this->set('path_current', $this->router->get('actualPath')); 
        }

        $this->set('total', $total);
    }
}
