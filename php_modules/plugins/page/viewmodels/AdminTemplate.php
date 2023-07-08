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

class AdminTemplate extends ViewModel
{
    public static function register()
    {
        return [
            'layout'=>'backend.template.form',
        ];
    }

    private function getItem()
    {
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars ? (int) $urlVars['id'] : 0;

        $newTemplate = [];
        if (!$id)
        {
            $newTemplate = $this->TemplateModel->new();
        }

        $data = $id ? $this->TemplateEntity->findByPK($id) : $newTemplate;

        return $data;
    }
    
    public function form()
    {
        $data = $this->getItem();
        $form = new Form($this->getFormFields(), $data);
        $id = empty($data) ? 0 : $data['id'];
        $widgets = $this->WidgetModel->getTypes();

        return [
            'title_page' => 'Template form',
            'id' => $id,
            'form' => $form,
            'url' => $this->router->url(),
            'widgets' => $widgets,
            'link_form' => $this->router->url('template'),
            'link_list' => $this->router->url('templates'),
            'link_load_widget' => $this->router->url('template/load-widget'),
            'data' => $data,
        ];
        
    }

    public function getFormFields()
    {
        $paths = $this->TemplateModel->getPathList();
        $pathOptions = [];
        $positionHub = [];
        foreach($paths as $path=>$arr)
        {
            list($theme, $tpl, $detail) = $arr;
            $pathOptions[] = [
                'text' => $detail->title,
                'value' => $path
            ];
            $positionHub[$path] = $detail->positions;
        }

        $data = $this->getItem();
        $positionData = empty($data) ? '' : $data['positions'];

        $widgetOptions = [];
        $widgets = $this->WidgetModel->getTypes();
        foreach($widgets as $key => $value)
        {
            $widgetOptions[] = [
                'text' => $value['name'],
                'value' => $key
            ];
        }

        $fields = [
            'path' => [
                'option',
                'type' => 'select',
                'formClass' => 'form-select',
                'options' => $pathOptions,
                'placeholder' => 'Template',
                'label' => 'Template',
                'formClass' => 'form-control',
            ],
            'id' => [
                'hidden',
            ],
            'position' => [
                'hidden',
            ],
            'widgets' => [
                'option',
                'type' => 'select',
                'formClass' => 'form-select',
                'options' => $widgetOptions,
                'showLabel' => false,
                'formClass' => 'form-control',
            ],
            'title' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'Template Name',
                'formClass' => 'form-control mb-3',
                'required' => 'required',
            ],
            'note' => [
                'textarea',
                'showLabel' => false,
                'placeholder' => 'Notice',
                'formClass' => 'form-control',
            ],
            'positions' => [
                'App\\plugins\\page\\libraries\\fields\\Position',
                'type' => 'position',
                'layout' => 'page::fields.position',
                'showLabel' => false,
                'data' => $positionData,
                'hub' => $positionHub
            ],
            'token' => ['hidden',
                'default' => $this->token->value(),
            ],
        ];

        return $fields;
    }
}
