<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\report_calendar\controllers;

use DTM\report\libraries\ReportController;
use SPT\Web\ControllerMVVM;

class ajax extends ReportController 
{
    public function find()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];
       
        $current_day = $this->request->post->get('current_day', 0, 'int');
        $action = $this->request->post->get('action', 0, 'int');
        $list = [];
        $this->app->set('format', 'json');
        $this->set('status' , 'success');
        $this->set('data' , $list);
        $this->set('message' , '');
        return;
    }
}
