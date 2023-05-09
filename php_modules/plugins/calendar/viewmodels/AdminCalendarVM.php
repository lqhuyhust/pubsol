<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\calendar\viewmodels;

use SPT\View\Gui\Form;
use SPT\View\Gui\Listing;
use SPT\View\VM\JDIContainer\ViewModel;
use stdClass;

class AdminCalendarVM extends ViewModel
{
    protected $alias = 'AdminCalendarVM';

    public static function register()
    {
        return [
            'layouts.backend.calendar.diagram',
            'layouts.backend.calendar.filter',
        ];
    }

    public function diagram()
    {
        $user = $this->container->get('user');
        $router = $this->container->get('router');
        $request = $this->container->get('request');
        $RequestEntity = $this->container->get('RequestEntity');
        $RelateNoteEntity = $this->container->get('RelateNoteEntity');
        $CalendarModel = $this->container->get('CalendarModel');
        $MilestoneEntity = $this->container->get('MilestoneEntity');
        
        $filter = $this->filter()['form'];
        $limit  = $filter->getField('limit')->value;
        $milestone   = $filter->getField('milestone')->value;
        $search = $filter->getField('search')->value;
        $page   = $request->get->get('page', 1);
        $where = [];

        if ($milestone && is_array($milestone))
        {
            $where_milestone = [];
            foreach($milestone as $item)
            {
                if ($item)
                {
                    $where_milestone[] = '(milestone_id = '. $item. ')';
                }
            }

            if ($where_milestone)
            {
                $where[] = '('. implode(' OR ', $where_milestone) . ')';
            }
        }

        if ($search)
        {
            $where[] = ["title like '%". $search. "%'"];
        }

        $list = $RequestEntity->list(0, 0, $where,'start_at asc, id asc');

        $list = $list ? $list : [];
        $calendar = [];
        foreach ($list as $item)
        {
            $tmp = new \stdClass();
            if($item['start_at'] && $item['start_at'] != '0000-00-00 00:00:00')
            {
                $tmp->title = $item['title'];
                $tmp->start = date('Y-m-d', strtotime($item['start_at']));
                $tmp->url = $router->url('detail-request') . '/'. $item['id'];
                if($item['finished_at'] && $item['finished_at'] != '0000-00-00 00:00:00')
                {
                    $tmp->end = date('Y-m-d', strtotime($item['finished_at']));
                }
                $calendar[] = $tmp;
            }
        }

        return [
            'user_id' => $user->get('id'),
            'list' => $list,
            'calendar' => json_encode($calendar, JSON_UNESCAPED_UNICODE),
            'current_date' => date('Y-m-d'),
            'url' => $router->url(),
            'link_detail' => $router->url('detail-request'),
            'title_page' => 'Calendar',
            'link_form' => $router->url('timeline'),
            'token' => $this->container->get('token')->getToken(),
        ];
    }

    protected $_filter;
    public function filter()
    {
        if (null === $this->_filter) :
            $data = [
                'search' => $this->state('search', '', '', 'post', 'calendar.search'),
                'tags' => $this->state('tags', '', '', 'post', 'calendar.tags'),
                'limit' => $this->state('limit', 10, 'int', 'post', 'calendar.limit'),
                'sort' => $this->state('sort', '', '', 'post', 'calendar.sort'),
                'milestone' => $this->state('milestone', [], 'array', 'post', 'calendar.milestone'),
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
            $this->_filter = $filter;
        endif;

        return ['form' => $this->_filter];
    }

    public function getFilterFields()
    {
        $MilestoneEntity = $this->container->get('MilestoneEntity');
        $milestones = $MilestoneEntity->list(0, 0);
        $option_milestone = [];
        foreach ($milestones as $milestone) 
        {
            $option_milestone[] = [
                'text' => $milestone['title'],
                'value' => $milestone['id'],
            ];
        }

        $NoteEntity = $this->container->get('NoteEntity');
        $notes = $NoteEntity->list(0, 0);
        $option_note = [];
        foreach ($notes as $note) 
        {
            $option_note[] = [
                'text' => $note['title'],
                'value' => $note['id'],
            ];
        }

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
            'milestone' => [
                'option',
                'type' => 'multiselect',
                'default' => '0',
                'formClass' => '',
                'placeholder' => 'All Milestone',
                'options' => $option_milestone,
                'showLabel' => false
            ],
            'note' => [
                'option',
                'type' => 'multiselect',
                'default' => '0',
                'formClass' => '',
                'placeholder' => 'All Note',
                'options' => $option_note,
                'showLabel' => false
            ],
            'limit' => [
                'option',
                'formClass' => 'form-select',
                'default' => 10,
                'options' => [5, 10, 20, 50],
                'showLabel' => false
            ],
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
