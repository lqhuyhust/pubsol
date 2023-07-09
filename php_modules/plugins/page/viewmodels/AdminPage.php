<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\page\viewmodels;

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
        $id = $urlVars ? (int) $urlVars['id'] : 0;

        $data = $id ? $this->PageEntity->findByPK($id) : [];

        return $data;
    }
    
    public function form()
    {
        $data = $this->getItem();
        $form = new Form($this->getFormFields(), $data);
        $id = empty($data) ? 0 : $data['id'];

        return [
            'title_page' => 'Page form',
            'id' => $id,
            'form' => $form,
            'url' => $this->router->url(),
            'link_form' => $this->router->url('page'),
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

        $page_type = $this->PageModel->getPageTypes();
        $typeOptions = [];
        foreach($page_type as $key => $value)
        {
            $typeOptions[] = [
                'text' => $value['name'],
                'value' => $key
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
            'page_type' => [
                'option',
                'type' => 'select',
                'formClass' => 'form-select',
                'options' => $typeOptions,
                'label' => 'Content',
                'formClass' => 'form-control',
            ],
            'token' => ['hidden',
                'default' => $this->token->value(),
            ],
        ];

        return $fields;
    }
}
