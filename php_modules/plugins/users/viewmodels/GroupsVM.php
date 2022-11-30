<?php
/**
 * SPT software - ViewModel
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 *
 */

namespace App\plugins\users\viewmodels;

use SPT\View\Gui\Form;
use SPT\View\Gui\Listing;
use SPT\View\VM\JDIContainer\ViewModel;
use SPT\Util;

class GroupsVM extends ViewModel
{
    protected $alias = 'AdminGroupsVM';
    protected $layouts = [
        'layouts.backend.userGroup' => [
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
        $page   = $this->request->get->get('page', 1, 'int');

        if ($page <= 0) $page = 0;
        $start  = ($page-1) * $limit;

        $where = [];
        if( !empty($search) )
        {
            $where[] = "(`name` LIKE '%".$search."%' )";
        }

        $sort = $sort ? $sort : '`id` DESC';
        $result = $this->GroupEntity->list( $start, $limit, $where, $sort);
        $total = $this->GroupEntity->getListTotal();

        if (!$result)
        {
            $result = [];
            $total = 0;
            $this->session->set('flashMsg', 'Not Found User Group!');
        }
        $i = 0;

        foreach($result as &$group) {
            //get users in group
            $userIn = $this->UserGroupEntity->getUserActive($group['id']);
            $userInGroup = $this->UserGroupEntity->getListTotal();
            $group['user_in'] = $userInGroup;

            //get Right Access
            $group['access'] = (array) json_decode($group['access']);
            $keys = $this->UserModel->getRightAccess();
            foreach($group['access'] as $key => $value)
            {
                if (!in_array($value, $keys))
                {
                    unset($group['access'][$key]);
                }
            }
        }
        $list   = new Listing($result, $total, $limit, $this->getColumns() );

        $this->set('search_status', $status, true);
        $this->set('sort', $sort, true);
        $this->set('start', $start, true);
        $this->set('list', $list, true);
        $this->set('page', $page, true);
        $this->set('url', $this->router->url(), true);
        $this->set('link_user_group_list', $this->router->url('admin/userGroups'), true);
        $this->set('link_user_group_form', $this->router->url('admin/userGroupUpdate/'), true);
        $this->set('link_user_group_form_add', $this->router->url('admin/userGroupAdd'), true);
        $this->set('link_delete_user_group', $this->router->url('admin/userGroupsDelete'), true);
        $this->set('link_update_user_group', $this->router->url('admin/userGroupsUpdate'), true);
        $this->set('token', $this->app->getToken(), true);
    }

    public function getColumns()
    {
        return [
            'num' => '#',
            'name' => 'Name',
            'description' => 'Description',
            'right_access' => 'Right access',
            'status' => 'Status',
            'col_last' => ' ',
        ];
    }

    protected $_filter;
    public function filter()
    {
        if( null === $this->_filter):
            $data = [
                'search' => $this->state('search', '', '', 'post', 'user-groups.search'),
                'search_status' => $this->state('search_status', '', '', 'post', 'user-groups.search_status'),
                'status' => $this->state('status', '','', 'post', 'user-groups.status'),
                'limit' => $this->state('limit', 10, 'int', 'post', 'user-groups.limit'),
                'sort' => $this->state('sort', '', '', 'post', 'user-groups.sort')
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
            'search_status' => ['text',
                'default' => '',
            ],
            'status' => ['option',
                'default' => '',
                'formClass' => 'form-select',
                'options' => [
                    ['text' => '--', 'value' => ''],
                    ['text' => 'Blocked', 'value' => '1'],
                    ['text' => 'Active', 'value' => '0']
                ],
                'showLabel' => false
            ],
            'limit' => ['option',
                'formClass' => 'form-select',
                'default' => 10,
                'options' => [ 5, 10, 20, 50],
                'showLabel' => false
            ],
            'sort' => ['hidden',
                'formClass' => 'form-select',
                'default' => 'name asc',
                'options' => [
                    ['text' => 'Name ascending', 'value' => 'name asc'],
                    ['text' => 'Name descending', 'value' => 'name desc'],
                    ['text' => 'Status ascending', 'value' => 'status asc'],
                    ['text' => 'Status descending', 'value' => 'status desc'],
                ],
                'showLabel' => false
            ]
        ];
    }

    public function row()
    {
        $this->set('item', $this->view->list->getRow());
        $this->set('index', $this->view->list->getIndex());
    }
}
