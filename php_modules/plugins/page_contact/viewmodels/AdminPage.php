<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\page_contact\viewmodels;

use SPT\Web\ViewModel;
use SPT\Web\Gui\Form;

class AdminPage extends ViewModel
{
    public static function register()
    {
        return [
            'layout'=>'backend.page.form',
        ];
    }

    private function getItem()
    {
        $urlVars = $this->request->get('urlVars');
        $id = isset($urlVars['id']) ? (int) $urlVars['id'] : 0;
        $data = $id ? $this->PageEntity->findByPK($id) : [];

        return $data;
    }
    
    public function form()
    {
        $data = $this->getItem();
        $form = new Form($this->getFormFields(), $data);
        $id = empty($data) ? 0 : $data['id'];
        $button_header = [
            [
                'link' => $this->router->url('pages') ,
                'class' => 'btn btn-outline-secondary',
                'title' => 'Cancel',
            ],
            [
                'link' => '',
                'class' => 'btn ms-2 btn-outline-success btn-save-close',
                'title' => 'Save & Close',
            ],
            [
                'link' => '',
                'class' => 'btn ms-2 btn-outline-success btn-apply',
                'title' => 'Apply',
            ],
        ];
        return [
            'title_page' => 'Page contact',
            'id' => $id,
            'button_header' => $button_header,
            'form' => $form,
            'url' => $this->router->url(),
            'link_form' => $id ? $this->router->url('page/detail') : $this->router->url('new-page/contact'),
            'link_list' => $this->router->url('pages'),
            'data' => $data,
        ];
        
    }

    public function getFormFields()
    {
        $templates = $this->TemplateEntity->list(0, 0);
        $templateOptions = [];
        foreach($templates as $item)
        {
            $templateOptions[] = [
                'text' => $item['title'],
                'value' => $item['id']
            ];
        }

        $fields = [
            'template_id' => [
                'option',
                'type' => 'select',
                'formClass' => 'form-select',
                'options' => $templateOptions,
                'placeholder' => 'Template',
                'label' => 'Template',
                'formClass' => 'form-control',
            ],
            'id' => [
                'hidden',
            ],
            'title' => [
                'text',
                'label' => 'Title',
                'placeholder' => 'Page Title',
                'formClass' => 'form-control',
                'required' => 'required',
            ],
            'slug' => [
                'text',
                'label' => 'Slug',
                'placeholder' => 'auto generate slug',
                'formClass' => 'form-control',
            ],
            'data' => [
                'tinymce',
                'label' => 'Content',
                'formClass' => 'd-none',
            ],
            'token' => ['hidden',
                'default' => $this->token->value(),
            ],
        ];

        return $fields;
    }
}
