<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */
namespace App\plugins\users\models;
use SPT\JDIContainer\Base;

class GroupModel extends Base
{
    public function getRightAccess($group)
    {   
        $result = $this->GroupEntity->findByPK($group);
        if($result['status'] != 1) {
            return $result = [];
        }
        if ($result)
        {
            $keys = (array) json_decode($result['right_access']);
        }
        
        return $keys;
    }

}