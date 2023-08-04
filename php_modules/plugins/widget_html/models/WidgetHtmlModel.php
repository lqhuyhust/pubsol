<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\widget_html\models;

use SPT\Container\Client as Base;

class WidgetHtmlModel extends Base
{ 
    use \SPT\Traits\ErrorString;
    
    public function validate($data)
    {
        if (!$data || !is_array($data))
        {
            $this->error = 'Error: Invalid data format.';
            return false;
        }

        if (!$data['title'])
        {
            $this->error = 'Error: Title can\'t empty.';
            return false;
        }

        if (!isset($data['template_id']) || !isset($data['position']))
        {
            $this->error = 'Invalid Template or Position';
            return false;
        }

        return $data;
    }

    public function getCurrentId()
    {
        $params = $this->request->get('urlVars');
        $id = $params['id'] ?? 0;
        return (int) $id;
    }

    public function add($data)
    {
        if (!$this->validate($data))
        {
            return false;
        }

        $position = $this->WidgetModel->convertPosition($data['position']);
        $position = $position ? implode(',', $position) : '';

        $newId =  $this->WidgetEntity->add([
            'title' => $data['title'],
            'settings' => '', // TODO
            'content' => $data['content'],
            'widget_type' => 'html',
            'template_id' => $data['template_id'],
            'position' => $position,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->user->get('id'),
            'locked_at' => date('Y-m-d H:i:s'),
            'locked_by' => $this->user->get('id'),
        ]);

        return $newId;
    }

    public function update($data)
    {
        if (!$this->validate($data) || empty($data['id']))
        {
            return false;
        }
        
        $try = $this->WidgetEntity->update([
            'title' => $data['title'],
            'content' => $data['content'], 
            'id' => $data['id'],
        ]);

        if (!$try)
        {
            $this->error = 'Error: Can\'t update the record.';
        }

        return $try;
    }

    public function remove($id)
    {
        return $this->WidgetEntity->remove($id);
    }

    public function getData($id)
    {
        $widget = $this->WidgetEntity->findByPK($id);
        $settings = $widget['settings'] ? json_decode($widget['settings'], true) : [];
        $widget['content'] = isset($settings['content']) ? $settings['content'] : '';

        return $widget;
    }
}
