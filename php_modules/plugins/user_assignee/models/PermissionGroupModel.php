<?php
namespace App\plugins\user_assignee\models;

use SPT\Container\Client as Base;

class PermissionGroupModel extends Base
{
    private $groups;

    public function checkPermission($assign_group)
    {
        if (!$this->groups)
        {
            $this->groups = $this->UserEntity->getGroups($this->user->get('id'));
        }

        if(!is_array($assign_group))
        {
            $assign_group = $this->AssignGroupModel->convert($assign_group, false);
        }

        foreach($this->groups as $group)
        {
            if(in_array($group['group_id'], $assign_group))
            {
                return true;
            }
        }

        return false;
    }
}