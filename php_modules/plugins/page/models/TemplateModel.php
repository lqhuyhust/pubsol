<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\page\models;

use SPT\Container\Client as Base;

class TemplateModel extends Base
{ 
    private $templates;
    public function getPathList()
    {
        if(null === $this->templates)
        {
            $this->templates = [];
            foreach(new \DirectoryIterator($this->app->get('themePath')) as $file) 
            {
                if (!$file->isDot() && $file->isDir()) 
                {
                    $template = $file->getBasename();
                    $path = $file->getPath(). '/'.$template;
                    foreach(new \DirectoryIterator( $path ) as $file) 
                    {
                        if (!$file->isDot() && (($file->isFile() && $file->getExtension() == 'php') || ($file->isDir()))) 
                        {
                            $basename = $file->getBasename('.php');
                            $json = $file->isDir() ? $path. '/'. $basename. '/'. $basename. '.json' : $path. '/'. $basename. '.json';
                            if(file_exists($json))
                            {
                                $this->templates[$template.'/'. $basename] = [
                                    $template,
                                    $basename,
                                    json_decode(file_get_contents($json) )
                                ];
                            }
                        }
                    }
                }
            }
        }
        return $this->templates;
    }

    public function getWidgets($id)
    {
        if (!$id)
        {
            return false;
        }

        $where = ['template_id' => $id];
        $list = $this->WidgetEntity->list(0, 0, $where);
        
        return $list;
    }
    
    public function new()
    {
        $where = ['created_by' => $this->user->get('id'), 'status' => 2];
        $find = $this->TemplateEntity->findOne($where);

        if (!$find)
        {
            $newId = $this->TemplateEntity->add([
                'fnc' => '',
                'title' => 'Template New',
                'note' => '',
                'positions' => '',
                'path' => '',
                'status' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->user->get('id'),
                'locked_at' => date('Y-m-d H:i:s'),
                'locked_by' => $this->user->get('id'),
            ]);

            if (!$newId)
            {
                return false;
            }

            $find = $this->TemplateEntity->findByPK($newId);
        }

        return $find;
    }

    // Write your code here
    public function remove($id)
    {
        if (!$id)
        {
            return false;
        }

        $this->WidgetModel->removeByTemplate($id);
        
        return $this->TemplateEntity->remove($id);
    }

    public function validate($data)
    {
        if (!$data || !is_array($data))
        {
            return false;
        }

        if (!$data['title'])
        {
            $this->session->set('flashMsg', 'Error: Title can\'t empty! ');
            return false;
        }

        if (!$data['path'])
        {
            $this->session->set('flashMsg', 'Error: Invalid Path! ');
            return false;
        }

        return $data;
    }

    public function add($data)
    {
        $try = $this->validate($data);
        if (!$try)
        {
            return false;
        }

        $where = ['created_by' => $this->user->get('id'), 'status' => 2];
        $findTmp = $this->TemplateEntity->findOne($where);
        if ($findTmp)
        {
            $data['id'] = $findTmp['id'];
            $try = $this->update($findTmp);
            if ($try)
            {
                return $findTmp['id'];
            }
            return false;
        }

        $newId =  $this->TemplateEntity->add([
            'title' => $data['title'],
            'fnc' => '',
            'positions' => '',
            'note' => $data['note'],
            'path' => $data['path'],
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->user->get('id'),
            'locked_at' => date('Y-m-d H:i:s'),
            'locked_by' => $this->user->get('id'),
        ]);

        return $newId;
    }

    public function update($data)
    {
        $try = $this->validate($data);
        if (!$try || !isset($data['id']) || !$data['id'])
        {
            return false;
        }

        $try = $this->TemplateEntity->update([
            'title' => $data['title'],
            'path' => $data['path'],
            'note' => $data['note'],
            'status' => 1,
            'id' => $data['id'],
        ]);

        return $try;
    }

    public function getWidgetPosition($id)
    {
        $widgets = $this->getWidgets($id);

        $positions= [];
        $types = $this->WidgetModel->getTypes();
        foreach($widgets as $widget)
        {
            if (!isset($positions[$widget['position']]))
            {
                $positions[$widget['position']] = [];
            }

            $settings = $widget['settings'] ? json_decode($widget['settings'], true) : [];
            foreach($settings as $key => $value)
            {
                $widget[$key] = $value;
            }
            $widget['layout'] = isset($types[$widget['widget_type']]) ? $types[$widget['widget_type']]['layout'] : '' ;

            $positions[$widget['position']][] = $widget;
        }

        return $positions;
    }
}
