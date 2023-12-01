<?php

/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\member\models;

use SPT\Container\Client as Base;
use SPT\Traits\ErrorString;

class MemberModel extends Base
{
    use ErrorString;

    public function add($data)
    {
        $data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'created_by' => $this->user->get('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s')
        ];

        $data = $this->MemberEntity->bind($data);
        if (!$data)
        {
            $this->error = $this->MemberEntity->getError();
            return false;
        }

        $newId = $this->MemberEntity->add($data);
        if (!$newId)
        {
            $this->error = $this->MemberEntity->getError();
        }

        return $newId;
    }

    public function update($data)
    {
        $data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s'),
            'id' => $data['id'],
        ];

        $data = $this->MemberEntity->bind($data);
        if (!$data)
        {
            $this->error = $this->MemberEntity->getError();
            return false;
        }

        $try = $this->MemberEntity->update($data);

        if (!$try)
        {
            $this->error = $this->MemberEntity->getError();
        }

        return $try;
    }

    public function remove($id)
    {
        if (!$id) return false;
        $try = $this->MemberEntity->remove($id);

        return $try;
    }
}