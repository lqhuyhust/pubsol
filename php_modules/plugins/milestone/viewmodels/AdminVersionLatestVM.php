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
use SPT\View\VM\JDIContainer\ViewModel;

class AdminVersionLatestVM extends ViewModel
{
    protected $alias = 'AdminVersionLatestVM';
    protected $layouts = [
        'layouts.backend.version_latest' => [
            'list'
        ]
    ];

    public function form()
    {
        $urlVars = $this->request->get('urlVars');
        $request_id = (int) $urlVars['request_id'];

        $editor = $this->request->get->get('editor', '');
        $data = $request_id ? $this->DocumentEntity->findOne(['request_id = '. $request_id ]) : [];
        $editor = $data ? $editor : 1;
        $form = new Form($this->getFormFields(), $data ? $data : []);
        $request = $this->RequestEntity->findByPK($request_id);
        $milestone = $request ? $this->MilestoneEntity->findByPK($request['milestone_id']) : ['title' => '', 'id' => 0];
        $title_page = $request ? '<a href="'. $this->router->url('admin/requests/'. $milestone['id']).'" >'.$milestone['title'] .'</a> >> Request: '. $request['title'] .' - Document' : 'Document';

        $history = $this->DocumentHistoryEntity->list(0,0,['document_id = '.$data['id']]);
        $discussion = $this->DiscussionEntity->list(0, 0, ['document_id = '. $data['id']], 'sent_at asc');
        $discussion = $discussion ? $discussion : [];
        foreach ($discussion as &$item)
        {
            $user_tmp = $this->UserEntity->findByPK($item['user_id']);
            $item['user'] = $user_tmp ? $user_tmp['name'] : '';
        }

        $this->set('form', $form, true);
        $this->set('data', $data, true);
        $this->set('history', $history ? $history : []);
        $this->set('discussion', $discussion ? $discussion : []);
        $this->set('editor', $editor);
        $this->set('user_id', $this->user->get('id'));
        $this->set('title_page', $title_page, true);
        $this->set('url', $this->router->url(), true);
        $this->set('link_list', $this->router->url('admin/document/'. $request_id));
        $this->set('link_form', $this->router->url('admin/document/'. $request_id));
        $this->set('link_form_comment', $this->router->url('admin/discussion/'. $request_id));
    }

    public function list()
    {
        $version_latest = $this->VersionEntity->list(0, 1, [], 'created_at desc');
        $version_latest = $version_latest ? $version_latest[0] : [];
        $urlVars = $this->request->get('urlVars');
        $request_id = (int) $urlVars['request_id'];
        $this->set('request_id', $request_id, true);

        $list = $list ? $list : [];
        $request = $this->RequestEntity->findByPK($request_id);
        $milestone = $request ? $this->MilestoneEntity->findByPK($request['milestone_id']) : ['title' => '', 'id' => 0];
        $title_page = $request ? '<a href="'. $this->router->url('admin/requests/'. $milestone['id']).'" >'.$milestone['title'] .'</a> >> Request: '. $request['title'] .' - Version' : 'Version';

        $this->set('list', $list, true);
        $this->set('url', $this->router->url(), true);
        $this->set('link_list', $this->router->url('admin/request-version/'. $request_id), true);
        $this->set('link_cancel', $this->router->url('admin/request-version/'. $request_id), true);
        $this->set('title_page', $title_page, true);
        $this->set('link_form', $this->router->url('admin/request-version/'. $version_latest['id']), true);
        $this->set('token', $this->app->getToken(), true);
    }

}
