<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\user_assignee\viewmodels;

use SPT\Web\ViewModel;
use SPT\Web\Gui\Form;

class UserAssignee extends ViewModel
{
    public static function register()
    {
        return [
            'widget'=>[
                'backend.javascript',
                'backend.assignee',
            ],
        ];
    }
    
    public function javascript()
    {
        return [
            'link_assignee' => $this->router->url('user/search'),
        ];
    }

    public function assignee($layoutData, $viewData)
    {
        $data = isset($viewData['data']) ? $viewData['data'] : [];
        $assignee = isset($data['assignee']) ? $data['assignee'] : '';

        $assignee = $this->AssigneeModel->convert($assignee, false);
        if (!$assignee)
        {
            $assignee = [];
        }

        $users = $this->UserEntity->list(0, 0, []);
        $user_groups = $this->GroupEntity->list(0,0, []);
        

        $data = isset($viewData['data']) ? $viewData['data'] : [];
        $assign_group = isset($data['assign_group']) ? $data['assign_group'] : '';
        $assign_group = $this->AssignGroupModel->convert($assign_group, false);
        if (!$assign_group)
        {
            $assign_group = [];
        }

        return [
            'assignee' => $assignee,
            'assign_group' => $assign_group,
            'users' => $users,
            'user_groups' => $user_groups,
        ];
    }
}
