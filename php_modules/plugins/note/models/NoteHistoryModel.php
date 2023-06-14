<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\note\models;

use SPT\Container\Client as Base;

class NoteHistoryModel extends Base
{ 
    public function add($data)
    {
        if (!$data || !isset($data['id']) || !$data['id'])
        {
            return false;
        }

        $history = [
            'title' => $data['title'],
            'tags' => $data['tags'],
            'note' => $data['note'],
            'type' => $data['type'],
            'description' => $data['description'],
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s'),
        ];

        $try_note = $this->NoteHistoryEntity->add([
            'note_id' => $data['id'],
            'meta_data' => json_encode($history),
            'created_by' => $this->user->get('id'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $try_note;
    }

    public function removeByNote($id)
    {
        if (!$id)
        {
            return false;
        }

        $finds = $this->NoteHistoryEntity->list(0, 0, ['note_id' => $id]);
        foreach($finds as $item)
        {
            $try = $this->NoteHistoryEntity->remove($item['id']);
            if (!$try) return false;
        }

        return true;
    }
}
