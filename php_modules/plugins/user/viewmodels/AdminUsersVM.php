<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */
namespace App\plugins\user\viewmodels; 

use SPT\View\Gui\Form;
use SPT\View\Gui\Listing;
use SPT\View\VM\JDIContainer\ViewModel;
use SPT\Util;

class AdminUsersVM extends ViewModel
{
    protected $alias = 'AdminUsersVM';
    protected $layouts = [
        'layouts.backend.user' => [
            'list',
            'list.row',
            'list.filter'
        ]
    ];

    public function list()
    {
        $filter = $this->filter();

        $limit  = $filter->getField('limit')->value;
        $sort   = $filter->getField('sort')->value;
        $search = $filter->getField('search')->value;
        $status = $filter->getField('status')->value;
        $page   = $this->request->get->get('page', 1);
        if ($page <= 0) $page = 1;

        $where = [];
        

        if( !empty($search) )
        {
            $where[] = "(`username` LIKE '%".$search."%' ".
                "OR `name` LIKE '%".$search."%' ".
                "OR `email` LIKE '%".$search."%' )";
        }
        if(is_numeric($status))
        {
            $where[] = '`block`='. $status;
        }

        $start  = ($page-1) * $limit;
        $sort = $sort ? $sort : 'id DESC';

        $result = $this->UserEntity->list( $start, $limit, $where, $sort);
        $total = $this->UserEntity->getListTotal();

        if (!$result)
        {
            $result = [];
            $total = 0;
            $this->session->set('flashMsg', 'Not Found User');
        }

        $list   = new Listing($result, $total, $limit, $this->getColumns() );
        $this->set('list', $list, true);
        $this->set('page', $page, true);
        $this->set('start', $start, true);
        $this->set('sort', $sort, true);
        $this->set('user_id', $this->user->get('id'), true);
        $this->set('url', $this->router->url(), true);
        $this->set('link_list', $this->router->url('admin/users'), true);
        $this->set('title_page', 'User Manager', true);
        $this->set('link_form', $this->router->url('admin/user'), true);
        $this->set('token', $this->app->getToken(), true);
    }

    public function getColumns()
    {
        return [
            'num' => '#',
            'name' => 'Name',
            'username' => 'User name',
            'emal' => 'Email',
            'block' => 'Is block',
            'created_at' => 'Created at',
            'col_last' => ' ',
        ];
    }

    protected $_filter;
    public function filter()
    {
        if( null === $this->_filter):
            $data = [
                'search' => $this->state('search', '', '', 'post', 'users.search'),
                'status' => $this->state('status', '','', 'post', 'users.status'),
                'limit' => $this->state('limit', 10, 'int', 'post', 'users.limit'),
                'sort' => $this->state('sort', '', '', 'post', 'users.sort')
            ];

            $filter = new Form($this->getFilterFields(), $data);
            $this->set('form', ['filter' => $filter], true);
            $this->set('dataform', $data, true);

            foreach($data as $k=>$v) $this->set($k, $v);
            $this->_filter = $filter;
        endif;

        return $this->_filter;
    }

    public function getFilterFields()
    {
        return [
            'search' => ['text',
                'default' => '',
                'showLabel' => false,
                'formClass' => 'form-control h-full input_common w_full_475',
                'placeholder' => 'Search..'
            ],
            'status' => ['option',
                'default' => '1',
                'formClass' => 'form-select',
                'options' => [
                    ['text' => '--', 'value' => ''],
                    ['text' => 'Inactive', 'value' => '0'],
                    ['text' => 'Active', 'value' => '1']
                ],
                'showLabel' => false
            ],
            'limit' => ['option',
                'formClass' => 'form-select',
                'default' => 10,
                'options' => [ 5, 10, 20, 50],
                'showLabel' => false
            ],
            'sort' => ['option',
                'formClass' => 'form-select',
                'default' => 'name asc',
                'options' => [
                    ['text' => 'Name ascending', 'value' => 'name asc'],
                    ['text' => 'Name descending', 'value' => 'name desc']
                ],
                'showLabel' => false
            ]
        ];
    }

    public function row()
    {
        $row = $this->view->list->getRow();
        $this->set('item', $row);
        $this->set('index', $this->view->list->getIndex());
    }
}
