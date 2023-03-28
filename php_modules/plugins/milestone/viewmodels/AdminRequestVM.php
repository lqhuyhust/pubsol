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

class AdminRequestVM extends ViewModel
{
    protected $alias = 'AdminRequestVM';

    public static function register()
    {
        return [
            'layouts.backend.request' => [
                'form',
                'detail_request',
            ]
        ];
    }

    public function form()
    {
        $urlVars = $this->request->get('urlVars');
        
        $milestone_id = (int) $urlVars['milestone_id'];
        
        $form = new Form($this->getFormFields(), []);
        $this->set('form', $form, true);
        $this->set('url', $this->router->url(), true);
        $this->set('link_list', $this->router->url('requests/'. $milestone_id));
        $this->set('link_form', $this->router->url('request/'. $milestone_id));
    }

    public function getFormFields()
    {
        $fields = [
            'id' => ['hidden'],
            'title' => [
                'text',
                'placeholder' => 'New Request',
                'showLabel' => false,
                'formClass' => 'form-control h-50-px fw-bold rounded-0 fs-3',
                'required' => 'required'
            ],
            'description' => ['textarea',
                'placeholder' => 'Enter description',
                'showLabel' => false,
                'formClass' => 'form-control rounded-0 border border-1 py-1 fs-4-5',
            ],
            'finished_at' => ['date',
                'placeholder' => 'Enter Finished At',
                'showLabel' => false,
                'formClass' => 'form-control rounded-0 border border-1 py-1 fs-4-5',
            ],
            'deadline_at' => ['date',
                'placeholder' => 'Enter Deadline At',
                'showLabel' => false,
                'formClass' => 'form-control rounded-0 border border-1 py-1 fs-4-5',
            ],
            'token' => ['hidden',
                'default' => $this->app->getToken(),
            ],
        ];

        return $fields;
    }

    public function detail_request()
    {
        $urlVars = $this->request->get('urlVars');
        $request_id = (int) $urlVars['request_id'];
        $this->set('request_id', $request_id, true);
        $request = $this->RequestEntity->findByPK($request_id);
        $milestone = $request ? $this->MilestoneEntity->findByPK($request['milestone_id']) : ['title' => '', 'id' => 0];
        
        $title_page = '<a class="me-2" href="'.$this->router->url('notes').'">Notes</a> | <a class="ms-2" href="'. $this->router->url('requests/'. $milestone['id']).'" >'. $milestone['title'].'</a> >> Request: '. $request['title'].  '<a type="button" class="ms-3" id="edit-request"  data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#formModalToggle" ><i class="fa-solid fa-pen-to-square"></i></a>';
        $this->set('link_form_request', $this->router->url('request/'. $milestone['id'] . '/' . $request['id']), true);
        $this->set('title_page', $title_page, true);
        $this->set('request', $request, true);
    }
}
