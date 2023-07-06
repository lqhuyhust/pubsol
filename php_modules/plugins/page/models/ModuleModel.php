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

class ModuleModel extends Base
{ 
    private $module_types;
    public function getModuleTypes()
    {
        if(null === $this->module_types)
        {
            $module_types = [];
            $this->app->familyLoad('moduletype', 'registerType', function($types) use (&$module_types) {
                $module_types = array_merge($types, $module_types);
            });

            $this->module_types = $module_types;
        }
        return $this->module_types;
    } 

    public function getModuleByPosition($template_id, $position)
    {
        if (!$template_id || !$position)
        {
            return false;
        }

        $where = ['template_id' => $template_id, 'position_name' => $position];
        $modules = $this->ModuleEntity->list(0, 0, $where);
        $module_types = $this->getModuleTypes();
        foreach($modules as &$item)
        {
            $item['path'] = isset($module_types[$item['module_type']]) ? $module_types[$item['module_type']]['path'] : '';
            $settings = $item['settings'] ? json_decode($item['settings'], true) : [];
            foreach($settings as $key => $value)
            {
                $item[$key] = $value;
            }
        }

        return $modules;
    }

    // Write your code here
    public function remove($id)
    {
        $where = [
            "(`templates` = '" . $id . "'" .
            " OR `templates` LIKE '%" . ',' . $id . "'" .
            " OR `templates` LIKE '" . $id . ',' . "%'" .
            " OR `templates` LIKE '%" . ',' . $id . ',' . "%' )"
        ];

        //find note
        $list_note = $this->NoteEntity->list(0, 0, $where);
        foreach($list_note as $note)
        {
            $templates = $note['templates'] ? explode(',', $note['templates']) : [];
            $key = array_search($id, $templates);
            unset($templates[$key]);
            $this->NoteEntity->update([
                'templates' => implode(',', $templates),
                'id' => $note['id'],
            ]);
        }

        //find Request
        $list_request = $this->RequestEntity->list(0, 0, $where);
        foreach($list_request as $request)
        {
            $templates = $request['templates'] ? explode(',', $request['templates']) : [];
            $key = array_search($id, $templates);
            unset($templates[$key]);
            $this->RequestEntity->update([
                'templates' => implode(',', $templates),
                'id' => $request['id'],
            ]);
        }

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

        if (!isset($data['template_id']) || !isset($data['position_name']))
        {
            $this->session->set('flashMsg', 'Invalid Template or Position');
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

        $settings = isset($data['content']) ? json_encode(['content' => $data['content']]) : '';
        $newId =  $this->ModuleEntity->add([
            'title' => $data['title'],
            'settings' => $settings,
            'module_type' => 'html',
            'template_id' => $data['template_id'],
            'position_name' => $data['position_name'],
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

        $settings = isset($data['content']) ? json_encode(['content' => $data['content']]) : '';
        
        $try = $this->ModuleEntity->update([
            'title' => $data['title'],
            'settings' => $settings,
            'id' => $data['id'],
        ]);

        if (!$try)
        {
            $this->session->set('flashMsg', 'Update Failed!');
            return false;
        }

        return $try;
    }

    public function removeByTemplate($id)
    {
        if (!$id)
        {
            return false;
        }

        $try = $this->ModuleEntity->removeByTemplate($id);
        return $try;
    }
}
