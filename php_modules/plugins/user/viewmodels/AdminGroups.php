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
use SPT\Web\MVVM\ViewModel;

class AdminGroups extends ViewModel
{
    public static function register()
    {
        return [
            'layouts.backend.usergroup.list',
            'layouts.backend.usergroup.list.row',
            'layouts.backend.usergroup.list.filter'
        ];
    }

    public function list()
    {
        $request = $this->container->get('request');
        $token = $this->container->get('token');
        $UserGroupEntity = $this->container->get('UserGroupEntity');
        $router = $this->container->get('router');
        $GroupEntity = $this->container->get('GroupEntity');
        $UserModel = $this->container->get('UserModel');
        $session = $this->container->get('session');
        $user = $this->container->get('user');
        $filter = $this->filter()['form'];

        $limit  = $filter->getField('limit')->value;
        $sort   = $filter->getField('sort')->value;
        $search = $filter->getField('search')->value;
        $status = $filter->getField('status')->value;
        $page   = $request->get->get('page', 1, 'int');

        if ($page <= 0) $page = 1;

        $where = [];
        if( !empty($search) )
        {
            $where[] = "(`name` LIKE '%".$search."%' )";
        }

        if(is_numeric($status))
        {
            $where[] = '`status`='. $status;
        }

        $start  = ($page-1) * $limit;
        $sort = $sort ? $sort : 'name ASC';
        $result = $GroupEntity->list( $start, $limit, $where, $sort);
        $total = $GroupEntity->getListTotal();

        if (!$result)
        {
            $result = [];
            $total = 0;
            if( !empty($search) )
            {
                $session->set('flashMsg', 'Groups not found');
            }
        }

        foreach($result as &$group) {
            //get users in group
            $userIn = $UserGroupEntity->getUserActive($group['id']);
            $userInGroup = $UserGroupEntity->getListTotal();
            $group['user_in'] = $userInGroup;

            //get Right Access
            $group['access'] = (array) json_decode($group['access']);
            $keys = [];//$UserModel->getRightAccess();
            foreach($group['access'] as $key => $value)
            {
                if (!in_array($value, $keys))
                {
                    unset($group['access'][$key]);
                }
            }
        }

        $list   = new Listing($result, $total, $limit, $this->getColumns() );

        return [
            'list' => $list,
            'page' => $page,
            'start' => $start,
            'sort' => $sort,
            'user_id' => $user->get('id'),
            'url' => $router->url(),
            'link_list' => $router->url('user-groups'),
            'title_page' => 'User Group Manager',
            'link_form' => $router->url('user-group'),
            'token' => $token->getToken(),
        ];
        
    }

    public function getColumns()
    {
        return [
            'num' => '#',
            'name' => 'Name',
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
                'status' => $this->state('status', '','', 'post', 'user-groups.status'),
                'limit' => $this->state('limit', 10, 'int', 'post', 'user-groups.limit'),
                'sort' => $this->state('sort', '', '', 'post', 'user-groups.sort')
            ];

            $filter = new Form($this->getFilterFields(), $data);
            $this->_filter = $filter;
        endif;

        return ['form' => $this->_filter];
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
            'sort' => ['option',
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

    public function row($layoutData, $viewData)
    {
        $row = $viewData['list']->getRow();
        return [
            'item' => $row,
            'index' => $viewData['list']->getIndex(),
        ];
    }

    public function state($key, $default='', $format='cmd', $request_type='post', $sessionName='')
    {
        if(empty($sessionName)) $sessionName = $key;
        $session = $this->container->get('session');
        $request = $this->container->get('request');

        $old = $session->get($sessionName, $default);

        if( !is_object( $request->{$request_type} ) )
        {
            $var = null;
        }
        else
        {
            $var = $request->{$request_type}->get($key, $old, $format);
            $session->set($sessionName, $var);
        }

        return $var;
    }
}