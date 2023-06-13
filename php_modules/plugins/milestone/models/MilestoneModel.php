<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\milestone\models;

use SPT\Container\Client as Base;

class MilestoneModel extends Base 
{ 
    // Write your code here
    public function remove($id)
    {
        $requests = $this->RequestEntity->list(0, 0, ['milestone_id = '. $id]);
        $try = $this->MilestoneEntity->remove($id);
        if ($try)
        {
            foreach ($requests as $request)
            {
                $this->RequestModel->remove($request['id']);
            }
        }
        return $try;
    }   
}
