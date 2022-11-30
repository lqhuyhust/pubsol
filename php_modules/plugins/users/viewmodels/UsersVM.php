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

class UsersVM extends ViewModel
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
        $filter_group  = $filter->getField('group')->value;
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

        $groups = $this->GroupEntity->list( 0, 0, [], "name ASC");
        $sort = $sort ? $sort : 'id DESC';

        if ($filter_group)
        {
            $user_map = $this->UserGroupEntity->list(0, 0, ['group_id' => $filter_group]);
            $where_group[] = 0;
            foreach($user_map as $map)
            {
                $where_group[] = $map['user_id'];
            }
        
            $where[] = 'id IN ('. implode(',', $where_group) . ')';
        }
        $result = $this->UserEntity->list( $start, $limit, $where, $sort);
        $total = $this->UserEntity->getListTotal();

        

        foreach( $result as $key => &$value )
        {
            $result[$key]['groups'] = $this->UserEntity->getGroups($value['id']);
        }

        if (!$result)
        {
            $result = [];
            $total = 0;
            $this->session->set('flashMsg', 'Not Found User');
        }

        $list   = new Listing($result, $total, $limit, $this->getColumns() );
        $this->set('list', $list, true);
        $this->set('groups', $groups, true);
        $this->set('page', $page, true);
        $this->set('start', $start, true);
        $this->set('sort', $sort, true);
        $this->set('user_id', $this->user->get('id'), true);
        $this->set('url', $this->router->url(), true);
        $this->set('link_user_list', $this->router->url('admin/users'), true);
        $this->set('link_delete_user', $this->router->url('admin/usersDelete'), true);
        $this->set('link_update_user', $this->router->url('admin/usersUpdate'), true);
        $this->set('link_user_form', $this->router->url('admin/userUpdate/'), true);
        $this->set('link_user_form_add', $this->router->url('admin/userAdd'), true);
        $this->set('token', $this->app->getToken(), true);
    }

    public function getColumns()
    {
        return [
            'num' => '#',
            'name' => 'Name',
            'username' => 'User name',
            'emal' => 'Email',
            'group' => 'User group',
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
                'group' => $this->state('group', '' , '', 'post', 'users.group'),
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
            'group' => ['text'],
            'sort' => ['hidden',
                'formClass' => 'form-select',
                'default' => 'name asc',
                'options' => [
                    ['text' => 'Name ascending', 'value' => 'name asc'],
                    ['text' => 'Status ascending', 'value' => 'status asc'],
                    ['text' => 'Status descending', 'value' => 'status desc'],
                    ['text' => 'Name descending', 'value' => 'name desc']
                ],
                'showLabel' => false
            ]
        ];
    }

    public function row()
    {
        $row = $this->view->list->getRow();
        if (!file_exists(MEDIA_PATH. $row['avatar']) || !$row['avatar'])
        {
            $row['avatar'] = 'users/dummyUser.png';
        }
        $this->set('item', $row);
        $this->set('index', $this->view->list->getIndex());
    }
}
