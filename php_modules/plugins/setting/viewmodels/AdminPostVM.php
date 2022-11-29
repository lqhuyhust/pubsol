<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\facts4me\viewmodels; 

use SPT\View\VM\JDIContainer\ViewModel; 
use SPT\View\Gui\Form;

class AdminPostVM extends ViewModel
{
    protected $alias = 'AdminPostVM';
    protected $layouts = [
        'layouts.backend.post' => [
            'form'
        ]
    ];

    public function form()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];
        $this->set('id', $id, true);

        $data = $id ? $this->PostEntity->findByPK($id) : [];

        if ($data)
        {
        }

        $form = new Form($this->getFormFields(), $data);

        $title_page = $id ? 'Update Post' : 'New Post';
        $this->view->set('form', $form, true);
        $this->view->set('title_page', $title_page, true);
        $this->view->set('data', $data, true);
        $this->view->set('url', $this->router->url(), true);
        $this->view->set('link_list', $this->router->url('admin/posts'));
        $this->view->set('link_form', $this->router->url('admin/post'));
    }

    public function getFormFields()
    {
        $fields = [
            'id' => ['hidden'],
            'name' => [
                'text',
                'placeholder' => 'Name',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => 'required'
            ],
            'content' => [
                'tinymce',
                'placeholder' => 'Content',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => ''
            ],
            'status' => ['option',
                'showLabel' => false,
                'type' => 'radio',
                'formClass' => '',
                'options' => [
                    ['text'=>'Yes', 'value'=>1],
                    ['text'=>'No', 'value'=>0]
                ],
                'default' => 1,
            ],
            'token' => ['hidden',
                'default' => $this->app->getToken(),
            ],
        ];

        return $fields;
    }
}