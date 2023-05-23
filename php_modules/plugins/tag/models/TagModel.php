<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\tag\models;

use SPT\JDIContainer\Base; 

class TagModel extends Base
{ 
    // Write your code here
    public function remove($id)
    {
        $where = [
            "(`tags` = '" . $id . "'" .
            " OR `tags` LIKE '%" . ',' . $id . "'" .
            " OR `tags` LIKE '" . $id . ',' . "%'" .
            " OR `tags` LIKE '%" . ',' . $id . ',' . "%' )"
        ];

        //find note
        $list_note = $this->NoteEntity->list(0, 0, $where);
        foreach($list_note as $note)
        {
            $tags = $note['tags'] ? explode(',', $note['tags']) : [];
            $key = array_search($id, $tags);
            unset($tags[$key]);
            $this->NoteEntity->update([
                'tags' => implode(',', $tags),
                'id' => $note['id'],
            ]);
        }

        //find Request
        $list_request = $this->RequestEntity->list(0, 0, $where);
        foreach($list_request as $request)
        {
            $tags = $request['tags'] ? explode(',', $request['tags']) : [];
            $key = array_search($id, $tags);
            unset($tags[$key]);
            $this->RequestEntity->update([
                'tags' => implode(',', $tags),
                'id' => $request['id'],
            ]);
        }

        return $this->TagEntity->remove($id);
    }
}
