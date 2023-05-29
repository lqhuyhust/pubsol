<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */
namespace App\plugins\milestone\viewmodels; 

use SPT\View\Gui\Form;
use SPT\View\Gui\Listing;
use SPT\Web\MVVM\ViewModel;

class AdminRequests extends ViewModel
{
    public static function register()
    {
        return [
            'layouts.backend.request.list',
            'layouts.backend.request.list.row',
            'layouts.backend.request.list.filter',
        ];
    }

    public function list()
    {
        $request = $this->container->get('request');
        $session = $this->container->get('session');
        $router = $this->container->get('router');
        $RequestEntity = $this->container->get('RequestEntity');
        $MilestoneEntity = $this->container->get('MilestoneEntity');
        $TagEntity = $this->container->get('TagEntity');
        $UserEntity = $this->container->get('UserEntity');
        $VersionEntity = $this->container->get('VersionEntity');
        $user = $this->container->get('user');

        $filter = $this->filter()['form'];
        $urlVars = $request->get('urlVars');
        $milestone_id = (int) $urlVars['milestone_id'];

        $limit  = $filter->getField('limit')->value;
        $sort   = $filter->getField('sort')->value;
        $search = trim($filter->getField('search')->value);
        $page   = $request->get->get('page', 1);
        if ($page <= 0) $page = 1;

        $where = [];
        $where[] = ['milestone_id = '. $milestone_id];

        if( !empty($search) )
        {
            $where[] = "(`title` LIKE '%".$search."%')";
        }
        
        $start  = ($page-1) * $limit;
        $sort = $sort ? $sort : 'title asc';

        $result = $RequestEntity->list( $start, $limit, $where, $sort);
        $total = $RequestEntity->getListTotal();
        if (!$result)
        {
            $result = [];
            $total = 0;
            if( !empty($search) )
            {
                $session->set('flashMsg', 'Not Found Request');
            }
        }
        $milestone = $MilestoneEntity->findByPK($milestone_id);
        $title_page = $milestone ? $milestone['title'] .' - Request List' : 'Request List';

        foreach($result as &$item)
        {
            $user_tmp = $UserEntity->findByPK($item['created_by']);
            $item['creator'] = $user_tmp ? $user_tmp['name'] : '';
            $tags = $item['tags'] ? explode(',', $item['tags']) : [];
            $tag_tmp = [];
            $item['tags'] = [];
            foreach($tags as $tag)
            {
                $tmp = $TagEntity->findByPK($tag);
                if ($tmp)
                {
                    $tag_tmp[] = $tmp['name'];
                    $item['tags'][] = $tmp;
                }
            }

            $item['tag_tmp'] = implode(' , ', $tag_tmp);
        }

        $version_lastest = $VersionEntity->list(0, 1, [], 'created_at desc');
        $version_lastest = $version_lastest ? $version_lastest[0]['version'] : '0.0.0';

        
        $limit = $limit == 0 ? $total : $limit;
        $list   = new Listing($result, $total, $limit, $this->getColumns());
        
        return [
            'milestone_id' => $milestone_id,
            'list' => $list,
            'version_lastest' => $version_lastest,
            'page' => $page,
            'start' => $start,
            'sort' => $sort,
            'user_id' => $user->get('id'),
            'url' => $router->url(),
            'link_list' => $router->url('requests/'. $milestone_id),
            'title_page' => $title_page,
            'link_form' => $router->url('request/'. $milestone_id),
            'link_detail' => $router->url('detail-request'),
            'token' => $this->container->get('token')->value(),
    
        ];
    }

    public function getColumns()
    {
        return [
            'num' => '#',
            'title' => 'Title',
            'description' => 'Description',
            'col_last' => ' ',
        ];
    }

    protected $_filter;
    public function filter()
    {
        if( null === $this->_filter):
            $data = [
                'search' => $this->state('search', '', '', 'post', 'request.search'),
                'limit' => $this->state('limit', 10, 'int', 'post', 'request.limit'),
                'sort' => $this->state('sort', '', '', 'post', 'request.sort')
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
            'limit' => ['option',
                'formClass' => 'form-select',
                'default' => 20,
                'options' => [
                    ['text' => '20', 'value' => 20],
                    ['text' => '50', 'value' => 50],
                    ['text' => 'All', 'value' => 0],
                ],
                'showLabel' => false
            ],
            'sort' => ['option',
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

    public function row($layoutData, $viewData)
    {
        $row = $viewData['list']->getRow();
        return [
            'item' => $row,
            'index' => $viewData['list']->getIndex()
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
