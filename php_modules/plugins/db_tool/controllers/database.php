<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\db_tool\controllers;

use SPT\Response;
use SPT\Web\ControllerMVVM;

class database extends ControllerMVVM
{
    public function checkavailability()
    {
        $entities = $this->DbToolModel->getEntities();
        foreach($entities as $entity)
        {
            $try = $this->{$entity}->checkAvailability();
            $status = $try ? 'success' : 'failed';
            echo str_pad($entity, 30) . $status ."\n";
        }

        echo "done.\n";
    }
}