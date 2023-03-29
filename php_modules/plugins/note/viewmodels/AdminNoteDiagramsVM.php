<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\note\viewmodels;

use SPT\View\Gui\Form;
use SPT\View\Gui\Listing;
use SPT\View\VM\JDIContainer\ViewModel;

class AdminNoteDiagramsVM extends ViewModel
{
    protected $alias = 'AdminNoteDiagramsVM';

    public static function register()
    {
        return [
            'layouts.backend.note_diagram' => [
                'list',
                'list.row',
                'list.filter'
            ]
        ];
    }

    public function list()
    {
        $filter = $this->filter();
        $limit  = $filter->getField('limit')->value;
        $sort   = $filter->getField('sort')->value;
        $search = $filter->getField('search')->value;
        $page   = $this->request->get->get('page', 1);
        if ($page <= 0) $page = 1;

        $where = [];

        if (!empty($search) && is_string($search)) {
            $tags = $this->TagEntity->list(0, 0, ["`name` LIKE '%" . $search . "%' "]);
            $where[] = "(`description` LIKE '%" . $search . "%')";
            $where[] = "(`note` LIKE '%" . $search . "%')";
            $where[] = "(`title` LIKE '%" . $search . "%')";
            if ($tags) {
                foreach ($tags as $tag) {
                    $where[] = "(`tags` = '" . $tag['id'] . "'" .
                        " OR `tags` LIKE '%" . ',' . $tag['id'] . "'" .
                        " OR `tags` LIKE '" . $tag['id'] . ',' . "%'" .
                        " OR `tags` LIKE '%" . ',' . $tag['id'] . ',' . "%' )";
                }
            }
            $where = [implode(" OR ", $where)];
        } 

        $start  = ($page - 1) * $limit;
        $sort = $sort ? $sort : 'title asc';

        $result = $this->NoteDiagramEntity->list($start, $limit, $where, $sort);
        $total = $this->NoteDiagramEntity->getListTotal();
        $data_tags = [];
        
        if (!$result) {
            $result = [];
            $total = 0;
            if (!empty($search)) {
                $this->session->set('flashMsg', 'Note Diagram not found');
            }
        }

        foreach ($result as $item) {
            if (!empty($item['tags'])) {
                $t1 = $where = [];
                $where[] = "(`id` IN (" . $item['tags'] . ") )";
                $t2 = $this->TagEntity->list(0, 0, $where, '', '`name`');
                if ($t2) {
                    foreach ($t2 as $i) {
                        $t1[] = $i['name'];
                    }
                }
                $data_tags[$item['id']] = implode(',', $t1);
            }
        }

        $list   = new Listing($result, $total, $limit, $this->getColumns());
        $this->set('list', $list, true);
        $this->set('data_tags', $data_tags, true);
        $this->set('page', $page, true);
        $this->set('start', $start, true);
        $this->set('sort', $sort, true);
        $this->set('user_id', $this->user->get('id'), true);
        $this->set('url', $this->router->url(), true);
        $this->set('link_list', $this->router->url('note-diagrams'), true);
        $this->set('title_page', 'Note Diagarm', true);
        $this->set('link_form', $this->router->url('note-diagram'), true);
        $this->set('token', $this->app->getToken(), true);
    }

    public function getColumns()
    {
        return [
            'num' => '#',
            'title' => 'Title',
            'created_at' => 'Created at',
            'col_last' => ' ',
        ];
    }

    protected $_filter;
    public function filter()
    {
        if (null === $this->_filter) :
            $data = [
                'search' => $this->state('search', '', '', 'post', 'note_diagram.search'),
                'tags' => $this->state('tags', '', '', 'post', 'note_diagram.tags'),
                'limit' => $this->state('limit', 10, 'int', 'post', 'note_diagram.limit'),
                'sort' => $this->state('sort', '', '', 'post', 'note_diagram.sort')
            ];
            if (strpos($data['search'], ';') == true) {
                $try = explode(';', $data['search']);
                $data['search'] = [];
                $tmp = [];
                foreach ($try as $key => $value) {
                    $tmp[] = $value;
                }
                $data['search'][] = $tmp;
            }
            $filter = new Form($this->getFilterFields(), $data);
            $this->set('form', ['filter' => $filter], true);
            $this->set('dataform', $data, true);

            foreach ($data as $k => $v) $this->set($k, $v);
            $this->_filter = $filter;
        endif;

        return $this->_filter;
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
                'default' => 'title asc',
                'options' => [
                    ['text' => 'Title ascending', 'value' => 'title asc'],
                    ['text' => 'Title descending', 'value' => 'title desc'],
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
