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

class RelateNoteModel extends Base 
{ 
    // Write your code here
    public function removeByNote($id)
    {
        if (!$id)
        {
            return false;
        }

        $finds = $this->RelateNoteEntity->list(0, 0, ['note_id' => $id]);
        foreach($finds as $item)
        {
            $try = $this->RelateNoteEntity->remove($item['id']);
            if (!$try) return false;
        }

        return true;
    }   

    public function  remove($id)
    {
        if (!$id) return false;
        $try = $this->RelateNoteEntity->remove($id);
        
        return $try;
    }

    public function addNote($notes, $request_id)
    {
        if (!$notes || !$request_id)
        {
            return false;
        }

        foreach($notes as $note_id)
        {
            $find = $this->RelateNoteEntity->findOne(['request_id' => $request_id, 'note_id' => $note_id]);
            if ($find) continue;
            
            $newId =  $this->RelateNoteEntity->add([
                'request_id' => $request_id,
                'title' => '',
                'note_id' => $note_id,
                'description' => '',
            ]);

            if (!$newId) return false;
        }

        return true;
    }
}
