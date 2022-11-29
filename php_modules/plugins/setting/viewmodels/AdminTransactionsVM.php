<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */
namespace App\plugins\facts4me\viewmodels; 

use SPT\View\Gui\Form;
use SPT\View\Gui\Listing;
use SPT\View\VM\JDIContainer\ViewModel;

class AdminTransactionsVM extends ViewModel
{
    protected $alias = 'AdminTransactionsVM';
    protected $layouts = [
        'layouts.backend.transaction' => [
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
            $where[] = "`transid` LIKE '%".$search."%'";
        }

        if( $status !== '' )
        {
            $where[] = "`status` LIKE '".$status."'";
        }

        $start  = ($page-1) * $limit;

        $sort = $sort ? $sort : 'id DESC';

        $result = $this->TransEntity->list( $start, $limit, $where, $sort);
        $total = $this->TransEntity->getListTotal();

        if (!$result)
        {
            $result = [];
            $total = 0;
            $this->session->set('flashMsg', 'Not Found Transaction');
        }

        $list   = new Listing($result, $total, $limit, $this->getColumns() );
        $this->set('list', $list, true);
        $this->set('page', $page, true);
        $this->set('start', $start, true);
        $this->set('sort', $sort, true);
        $this->set('url', $this->router->url(), true);
        $this->set('title_page', 'Transactions', true);
        $this->set('link_list', $this->router->url('admin/transactions'), true);
        $this->set('link_form', $this->router->url('admin/transaction'), true);
        $this->set('token', $this->app->getToken(), true);
    }
    
    public function getColumns()
    {
        return [
            'num' => '#',
            'e_name' => 'Name',
            'e_tmp' => 'Active',
            'col_last' => ' ',
        ];
    }

    protected $_filter;
    public function filter()
    {
        if( null === $this->_filter):
            $data = [
                'search' => $this->state('search', '', '', 'post', 'transaction.search'),
                'status' => $this->state('status', '','', 'post', 'transaction.status'),
                'limit' => $this->state('limit', 10, 'int', 'post', 'transaction.limit'),
                'sort' => $this->state('sort', '', '', 'post', 'transaction.sort')
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
                'default' => '',
                'formClass' => 'form-select',
                'options' => [
                    ['text' => '--', 'value' => ''],
                    ['text' => 'Success', 'value' => '1'],
                    ['text' => 'Fail', 'value' => '0']
                ],
                'showLabel' => false,
                'default' => '_',
            ],
            'limit' => ['option',
                'formClass' => 'form-select w-auto',
                'default' => 10,
                'options' => [ 5, 10, 20, 50],
                'showLabel' => false
            ],
            'sort' => ['option',
                'formClass' => 'form-select',
                'default' => 'e_name asc',
                'options' => [
                    ['text' => 'Sort By', 'value' => ''],
                    ['text' => 'ID ascending', 'value' => 'id asc'],
                    ['text' => 'ID descending', 'value' => 'id desc'],
                    ['text' => 'User ID ascending', 'value' => 'userid asc'],
                    ['text' => 'User ID descending', 'value' => 'userid desc']
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
