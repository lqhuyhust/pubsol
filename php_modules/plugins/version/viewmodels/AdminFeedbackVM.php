<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */
namespace App\plugins\version\viewmodels; 

use SPT\View\Gui\Form;
use SPT\View\Gui\Listing;
use SPT\View\VM\JDIContainer\ViewModel;
use SPT\Util;

class AdminFeedbackVM extends ViewModel
{
    protected $alias = 'AdminFeedbackVM';
    protected $layouts = [
        'layouts.backend.feedback' => [
            'list',
        ]
    ];

    public function list()
    {
        $urlVars = $this->request->get('urlVars');
        $version_id = (int) $urlVars['version_id'];
        $this->set('version_id', $version_id, true);

        $version = $this->VersionEntity->findByPK($version_id);
        $version = $version ? $version : ['name' => ''];
        $this->set('url', $this->router->url(), true);
        $this->set('link_cancel', $this->router->url('admin/versions'), true);
        $this->set('title_page', 'Feeback Of Version '. $version['name'], true);
        $this->set('token', $this->app->getToken(), true);
    }
}
