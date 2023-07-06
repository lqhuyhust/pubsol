<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\test\viewmodels;

use SPT\Web\ViewModel;
use SPT\View\Gui\Form;

class AdminTemplate extends ViewModel
{
    public static function register()
    {
        return [
            'layouts.backend.template.form',
            'vcoms.fields.position',
        ];
    }

    private function getItem()
    {
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars ? (int) $urlVars['id'] : 0;

        $data = $id ? $this->TemplateEntity->findByPK($id) : [];

        return $data;
    }
    
    public function form()
    {
        $data = $this->getItem();
        $form = new Form($this->getFormFields(), $data);
        $id = empty($data) ? 0 : $data['id'];

        return [
            'title_page' => 'Template form',
            'id' => $id,
            'form' => $form,
            'link_search' => $this->router->url('template/search'),
            'data' => $data,
        ];
        
    }

    public function getFormFields()
    {
        $paths = $this->TemplateModel->getTemplatePaths();
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
            'title' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'Template Name',
                'formClass' => 'form-control mb-3',
                'required' => 'required',
            ],
            'notice' => [
                'textarea',
                'showLabel' => false,
                'placeholder' => 'Notice',
                'formClass' => 'form-control',
            ],
            'positions' => [
                'position',
                'data' => $positionData,
                'hub' => $positionHub
            ],
            'token' => ['hidden',
                'default' => $this->token->value(),
            ],
        ];

        return $fields;
    }

    public function position()
    {
        return [];
    }
}
