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

class AdminTemplate extends ViewModel
{
    public static function register()
    {
        return [
            'layouts.backend.template.form',
            'vcoms.positions.header',
            'vcoms.positions.slider',
            'vcoms.positions.left',
            'vcoms.positions.footer',
            'vcoms.positions.feature',
            'vcoms.positions.menu',
        ];
    }

    private function getItem()
    {
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars ? (int) $urlVars['id'] : 0;

        $newTemplate = [];
        if (!$id)
        {
            $newTemplate = $this->TemplateModel->newTemplate();
        }

        $data = $id ? $this->TemplateEntity->findByPK($id) : $newTemplate;

        return $data;
    }
    
    public function form()
    {
        $data = $this->getItem();
        $form = new Form($this->getFormFields(), $data);
        $id = empty($data) ? 0 : $data['id'];
        $modules = $this->ModuleModel->getModuleTypes();

        return [
            'title_page' => 'Template form',
            'id' => $id,
            'form' => $form,
            'url' => $this->router->url(),
            'modules' => $modules,
            'link_form' => $this->router->url('template'),
            'link_list' => $this->router->url('templates'),
            'link_load_module' => $this->router->url('template/load-module'),
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

        $modules = $this->ModuleModel->getModuleTypes();
        foreach($modules as $key => $value)
        {
            $moduleOptions[] = [
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
            'modules' => [
                'option',
                'type' => 'select',
                'formClass' => 'form-select',
                'options' => $moduleOptions,
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

    public function getModuleTypes($position)
    {
        $page_id = $this->app->get('page_id');
        $page = $this->PageEntity->findByPK($page_id);
        
        $template_id = $page['template_id'];

        //find modules
        $modules = $this->ModuleModel->getModuleByPosition($template_id, $position);

        return $modules;
    }

    public function header()
    {
        $modules = $this->getModuleTypes('header');

        return [
            'modules' => $modules,
        ];
    }

    public function slider()
    {
        $modules = $this->getModuleTypes('slider');

        return [
            'modules' => $modules,
        ];
    }

    public function footer()
    {
        $modules = $this->getModuleTypes('footer');

        return [
            'modules' => $modules,
        ];
    }

    public function left()
    {
        $modules = $this->getModuleTypes('left');

        return [
            'modules' => $modules,
        ];
    }

    public function feature()
    {
        $modules = $this->getModuleTypes('feature');

        return [
            'modules' => $modules,
        ];
    }

    public function menu()
    {
        $modules = $this->getModuleTypes('menu');

        return [
            'modules' => $modules,
        ];
    }
}
