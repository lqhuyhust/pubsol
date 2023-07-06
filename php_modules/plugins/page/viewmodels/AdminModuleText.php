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
use SPT\View\Gui\Form;

class AdminModuleText extends ViewModel
{
    public static function register()
    {
        return [
            'layouts.backend.module.text.form',
            'vcoms.modules.text',
        ];
    }

    private function getItem()
    {
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars ? (int) $urlVars['id'] : 0;

        $data = $id ? $this->ModuleEntity->findByPK($id) : [];

        if ($data)
        {
            $settings = $data['settings'] ? json_decode($data['settings'], true) : [];
            foreach($settings as $key => $value)
            {
                $data[$key] = $value;
            }
        }
        return $data;
    }
    
    public function form()
    {
        $data = $this->getItem();
        $form = new Form($this->getFormFields(), $data);
        $id = empty($data) ? 0 : $data['id'];
        $message = $this->session->get('flashMsg');
        $this->session->set('flashMsg', '');

        return [
            'title_page' => 'Template form',
            'id' => $id,
            'url' => $this->router->url(''),
            'link_form' => $this->router->url('module/text'),
            'form' => $form,
            'message' => $message,
            'data' => $data,
        ];
        
    }

    public function getFormFields()
    {
        $fields = [
            'id' => [
                'hidden',
            ],
            'template_id' => [
                'hidden',
            ],
            'position_name' => [
                'hidden',
            ],
            'title' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'New Title',
                'formClass' => 'form-control',
                'required' => 'required',
            ],
            'content' => [
                'textarea',
                'showLabel' => false,
                'formClass' => 'form-control',
            ],
            'token' => ['hidden',
                'default' => $this->token->value(),
            ],
        ];

        return $fields;
    }

    public function text($layoutData, $viewData)
    {
        return [];
    }
}
