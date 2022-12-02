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

class AdminDocumentVM extends ViewModel
{
    protected $alias = 'AdminDocumentVM';
    protected $layouts = [
        'layouts.backend.document' => [
            'form'
        ]
    ];

    public function form()
    {
        $urlVars = $this->request->get('urlVars');
        $request_id = (int) $urlVars['request_id'];

        $data = $request_id ? $this->DocumentEntity->findOne(['request_id = '. $request_id ]) : [];

        $form = new Form($this->getFormFields(), $data ? $data : []);
        $request = $this->RequestEntity->findByPK($request_id);
        $milestone = $request ? $this->MilestoneEntity->findByPK($request['milestone_id']) : ['title' => '', 'id' => 0];
        $title_page = $request ? '<a href="'. $this->router->url('admin/requests/'. $milestone['id']).'" >'.$milestone['title'] .'</a> >> Request: '. $request['title'] .' - Document' : 'Document';

        $this->set('form', $form, true);
        $this->set('data', $data, true);
        $this->set('title_page', $title_page, true);
        $this->set('url', $this->router->url(), true);
        $this->set('link_list', $this->router->url('admin/document/'. $request_id));
        $this->set('link_form', $this->router->url('admin/document/'. $request_id));
    }

    public function getFormFields()
    {
        $fields = [
            'id' => ['hidden'],
            'description' => ['tinymce',
                'showLabel' => false,
                'formClass' => 'form-control',
            ],
            
            'token' => ['hidden',
                'default' => $this->app->getToken(),
            ],
        ];

        return $fields;
    }
}
