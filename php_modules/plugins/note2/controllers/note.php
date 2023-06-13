<?php
/**
 * SPT software - Note controller
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Manage all the access to Note feature
 *
 */

namespace App\plugins\note2\controllers;

use SPT\Web\ControllerMVVM;
use SPT\Response;

class note extends ControllerMVVM
{
    function test()
    {
        die('it works');
        $this->app->set('layout', 'backend.note.form');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }
}