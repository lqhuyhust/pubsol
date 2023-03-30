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

class AdminMilestoneVM extends ViewModel
{
    protected $alias = 'AdminMilestoneVM';

    public static function register()
    {
        return [
            'layouts.backend.milestone.form'
        ];
    }
    
    public function form()
    {
        $router = $this->container->get('router');
        $form = new Form($this->getFormFields(), []);

        return [
            'form' => $form,
            'url' => $router->url(),
            'link_list' => $router->url('milestones'),
            'link_form' => $router->url('milestone'),
        ];
    }

    public function getFormFields()
    {
        $fields = [
            'id' => ['hidden'],
            'title' => [
                'text',
                'placeholder' => 'New Milestone',
                'showLabel' => false,
                'formClass' => 'form-control h-50-px fw-bold rounded-0 fs-3',
                'required' => 'required',
            ],
            'description' => ['textarea',
                'placeholder' => 'Enter Description',
                'showLabel' => false,
                'formClass' => 'form-control rounded-0 border border-1 py-1 fs-4-5',
            ],
            'start_date' => ['date',
                'showLabel' => false,
                'formClass' => 'form-control rounded-0 border border-1 py-1 fs-4-5',
            ],
            'end_date' => ['date',
                'showLabel' => false,
                'formClass' => 'form-control rounded-0 border border-1 py-1 fs-4-5',
            ],
            'status' => ['option',
                'showLabel' => false,
                'type' => 'radio_inline',
                'formClass' => 'd-flex',
                'default' => 1,
                'options' => [
                    ['text'=>'Show', 'value'=>1],
                    ['text'=>'Hide', 'value'=>0]
                ]
            ],
            'token' => ['hidden',
                'default' => $this->container->get('token')->getToken(),
            ],
        ];

        return $fields;
    }
}
