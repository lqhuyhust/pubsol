<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */
namespace App\plugins\facts4me\viewmodels; 

use SPT\View\Gui\Form;
use SPT\View\Gui\Listing;
use SPT\View\VM\JDIContainer\ViewModel;

class AdminTransactionVM extends ViewModel
{
    protected $alias = 'AdminTransactionVM';
    protected $layouts = [
        'layouts.backend.transaction' => [
            'form',
        ]
    ];
    public function form()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];
        $this->set('id', $id, true);

        $data = $id ? $this->TransEntity->findByPK($id) : [];

        $this->view->set('title_page', 'Transaction Detail', true);
        $this->view->set('data', $data, true);
        $this->view->set('url', $this->router->url(), true);
        $this->view->set('link_list', $this->router->url('admin/transactions'));
        $this->view->set('link_form', $this->router->url('admin/transaction'));
    }

    public function getFormFields()
    {
        $fields = [
            'id' => ['hidden'],
            'topic_name' => [
                'text',
                'placeholder' => 'Topic Name',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => 'required'
            ],
            'topic_active' => ['option',
                'showLabel' => false,
                'type' => 'radio',
                'formClass' => '',
                'options' => [
                    ['text'=>'Yes', 'value'=>'Y'],
                    ['text'=>'No', 'value'=>'N']
                ],
                'default' => 'Y',
            ],
            'token' => ['hidden',
                'default' => $this->app->getToken(),
            ],
        ];

        return $fields;
    }
    
}
