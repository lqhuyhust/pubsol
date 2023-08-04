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
        $search = trim($this->request->post->get('search', '', 'string'));
        $position = $this->request->post->get('position', '', 'string');

        $data = $this->WidgetModel->search($search, $position);

        $this->app->set('format', 'json');
        $this->set('status' , 'success');
        $this->set('data' , $data);
        $this->set('message' , '');
        return;
    }
}