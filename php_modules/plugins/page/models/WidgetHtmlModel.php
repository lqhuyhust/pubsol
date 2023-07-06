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

class WidgetHtmlModel extends Base
{ 
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
        $newId =  $this->WidgetEntity->add([
            'title' => $data['title'],
            'settings' => $settings,
            'widget_type' => 'html',
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
        
        $try = $this->WidgetEntity->update([
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

    public function remove($id)
    {
        if (!$id)
        {
            return false;
        }

        $try = $this->WidgetEntity->remove($id);

        return $try;
    }

    public function getData($id)
    {
        if (!$id)
        {
            return false;
        }

        $widget = $this->WidgetEntity->findByPK($id);
        $settings = $widget['settings'] ? json_decode($widget['settings'], true) : [];
        $widget['content'] = isset($settings['content']) ? $settings['content'] : '';

        return $widget;
    }
}
