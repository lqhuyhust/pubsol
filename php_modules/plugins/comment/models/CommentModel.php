<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\comment\models;

use SPT\Container\Client as Base;

class CommentModel extends Base
{ 
    public function validate($data)
    {
        if (!$data && !is_array($data))
        {
            $this->error = 'Invalid format data';
            return false;
        }

        if(!$data['comment'])
        {
            $this->error = "Comment can't empty";
            return false;
        }

        if(!$data['object'] || !$data['object_id'])
        {
            $this->error = "Invalid object comment";
            return false;
        }

        return true;
    }

    public function add($data)
    {
        if (!$this->validate($data))
        {
            return false;
        }

        $try = $this->CommentEntity->add([
            'object' => $data['object'],
            'object_id' => $data['object_id'],
            'comment' => $data['comment'],
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->user->get('id'),
        ]);

        if (!$try)
        {
            $this->error = "Can't create comment";
            return false;
        }

        return $try;
    }

    public function update($data)
    {
        if (!$this->validate($data) || !$data['id'])
        {
            return false;
        }

        $try = $this->CommentEntity->update([
            'object' => $data['object'],
            'object_id' => $data['object_id'],
            'comment' => $data['comment'],
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->user->get('id'),
        ]);

        if (!$try)
        {
            $this->error = "Can't update comment";
            return false;
        }

        return $try;
    }

    public function remove($id)
    {
        if (!$id)
        {
            $this->error = 'Invalid id';
            return false;
        }

        $try = $this->CommentEntity->remove($id);

        if (!$try)
        {
            $this->error = "Can't remove comment";
            return false;
        }

        return $try;
    }
}
