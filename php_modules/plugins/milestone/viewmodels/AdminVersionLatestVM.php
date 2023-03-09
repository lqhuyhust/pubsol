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

    public function list()
    {
        $version_latest = $this->VersionEntity->list(0, 1, [], 'created_at desc');
        $version_latest = $version_latest ? $version_latest[0] : [];
        // if(!$version_latest){
        //     $this->session->set('flashMsg', 'Not Found Version');
        // }
        $urlVars = $this->request->get('urlVars');
        $request_id = (int) $urlVars['request_id'];
        $this->set('request_id', $request_id, true);

        if (!$version_latest)
        {
            $version_latest['id'] = 0;
        }

        $tmp_request = $this->RequestEntity->findOne(['id' => $request_id]);

        $list = $this->VersionNoteEntity->list(0,0, ['version_id = '. $version_latest['id'], 'request_id = '. $request_id]);
        $list = $list ? $list : [];
        $request = $this->RequestEntity->findByPK($request_id);
        $milestone = $request ? $this->MilestoneEntity->findByPK($request['milestone_id']) : ['title' => '', 'id' => 0];
        
        if($version_latest && $tmp_request['version_id']) {
            $title_page = 'Version changelog (Version: '. $tmp_request['version_id'].')';
        } else {
            $title_page = 'Version changelog (Please create Version first)';
        }

        $version_lastest = $this->VersionEntity->list(0, 1, [], 'created_at desc');
        $version_lastest = $version_lastest ? $version_lastest[0]['version'] : '0.0.0';
        $tmp_request = $this->RequestEntity->list(0, 0, ['id = '.$request_id], 0);
        foreach($tmp_request as $item) {
        }
        if(strcmp($item['version_id'], '0') == 0) {
            $status = false;
        } elseif ($version_lastest > $item['version_id']) {
            $status = true;
        } else {
            $status = false;
        }

        $this->set('list', $list, true);
        $this->set('version_latest', $version_latest);
        $this->set('status', $status);
        $this->set('url', $this->router->url(), true);
        $this->set('link_list', $this->router->url('request-version/'. $request_id), true);
        $this->set('link_cancel', $this->router->url('detail-request/'. $request_id), true);
        $this->set('title_page_version', $title_page, true);
        $this->set('link_form', $this->router->url('request-version/'. $request_id), true);
        $this->set('token', $this->app->getToken(), true);
    }

}
