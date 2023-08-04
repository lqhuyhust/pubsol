<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\widget\controllers;

use SPT\Web\ControllerMVVM;

class ajax extends ControllerMVVM
{
    public function list()
    {
        $search = trim($this->request->get->get('search', '', 'string'));
        $position = $this->request->get->get('position', '', 'string');

        $data = $this->WidgetModel->search($search, $position);

        $this->app->set('format', 'json');
        $this->set('status' , 'success');
        $this->set('data' , $data);
        $this->set('message' , '');
        return;
    }

    public function updateposition()
    {
        $select_widgets = $this->request->post->get('select_widgets', [], 'array');
        $position = $this->request->post->get('position', '', 'string');
        $try = $this->WidgetModel->updateposition($select_widgets, $position);

        $this->app->set('format', 'json');
        if (!$try)
        {
            $this->set('status' , 'failed');
            $this->set('message' , $this->WidgetModel->getError());
        }
        else
        {
            $this->set('status' , 'success');
            $this->set('message' , 'Update widget successfully');
        }
        return;

    }
}