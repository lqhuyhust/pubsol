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

        $finds = $this->RelatedNoteEntity->list(0, 0, ['note_id' => $id]);
        foreach($finds as $item)
        {
            $try = $this->RelatedNoteEntity->remove($item['id']);
            if (!$try) return false;
        }

        return true;
    }   
}
