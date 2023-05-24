<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\tag\viewmodels;

use SPT\View\Gui\Form;
use SPT\View\Gui\Listing;
use SPT\View\VM\JDIContainer\ViewModel;

class AdminTags extends ViewModel
{
    public static function register()
    {
        return [
            'layouts.backend.tag.list',
            'layouts.backend.tag.list.row',
            'layouts.backend.tag.list.filter'
        ];
    }

    public function list()
    {
        $request = $this->container->get('request');
        $TagEntity = $this->container->get('TagEntity');
        $session = $this->container->get('session');
        $router = $this->container->get('router');
        $token = $this->container->get('token');
        $user = $this->container->get('user');

        $filter = $this->filter()['form'];
        $limit  = $filter->getField('limit')->value;
        $sort   = $filter->getField('sort')->value;
        $search = $filter->getField('search')->value;
        $page   = $request->get->get('page', 1);
        if ($page <= 0) $page = 1;

        $where = [];

        if (!empty($search)) {
            $where[] = "(`name` LIKE '%" . $search . "%') OR (`description` LIKE '%" . $search . "%')";
        }

        $start  = ($page - 1) * $limit;
        $sort = $sort ? $sort : 'name asc';

        $result = $TagEntity->list($start, $limit, $where, $sort);
        $total = $TagEntity->getListTotal();
        
        if (!$result) {
            $result = [];
            $total = 0;
        }

        foreach ($result as &$item) 
        {
            $tag_tmp = [];
            if ($item['parent_id'])
            {
                $tag_tmp = $TagEntity->findByPK($item['parent_id']);
            }

            $item['parent_tag'] = $tag_tmp ? $tag_tmp['name'] : '';
        }

        $list   = new Listing($result, $total, $limit, $this->getColumns());
        return [
            'list' => $list,
            'page' => $page,
            'start' => $start,
            'sort' => $sort,
            'user_id' => $user->get('id'),
            'url' => $router->url(),
            'link_list' => $router->url('tags'),
            'title_page' => 'Tags',
            'link_form' => $router->url('tag'),
            'token' => $token->getToken(),
        ];
    }

    public function getColumns()
    {
        return [
            'num' => '#',
            'name' => 'Name',
            'description' => 'Description',
            'parent' => 'Parent',
            'col_last' => ' ',
        ];
    }

    protected $_filter;
    public function filter()
    {
        if (null === $this->_filter) :
            $data = [
                'search' => $this->state('search', '', '', 'post', 'tag.search'),
                'limit' => $this->state('limit', 10, 'int', 'post', 'tag.limit'),
                'sort' => $this->state('sort', '', '', 'post', 'tag.sort')
            ];
            $filter = new Form($this->getFilterFields(), $data);

            $this->_filter = $filter;
        endif;

        return ['form' => $this->_filter];
    }

    public function getFilterFields()
    {
        return [
            'search' => [
                'text',
                'default' => '',
                'showLabel' => false,
                'formClass' => 'form-control h-full input_common w_full_475',
                'placeholder' => 'Search..'
            ],
            'status' => [
                'option',
                'default' => '1',
                'formClass' => 'form-select',
                'options' => [
                    ['text' => '--', 'value' => ''],
                    ['text' => 'Show', 'value' => '1'],
                    ['text' => 'Hide', 'value' => '0'],
                ],
                'showLabel' => false
            ],
            'limit' => [
                'option',
                'formClass' => 'form-select',
                'default' => 10,
                'options' => [5, 10, 20, 50],
                'showLabel' => false
            ],
            'sort' => [
                'option',
                'formClass' => 'form-select',
                'default' => 'name asc',
                'options' => [
                    ['text' => 'name ascending', 'value' => 'name asc'],
                    ['text' => 'name descending', 'value' => 'name desc'],
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
