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

class AdminRequestVM extends ViewModel
{
    protected $alias = 'AdminRequestVM';
    protected $layouts = [
        'layouts.backend.request' => [
            'form'
        ]
    ];

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
            'token' => ['hidden',
                'default' => $this->app->getToken(),
            ],
        ];

        return $fields;
    }
}
