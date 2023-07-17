<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\note2_attachment\models;

use SPT\Container\Client as Base;

class NoteAttachmentModel extends Base
{ 
    use \SPT\Traits\ErrorString;
    
    public function getDetail($id)
    {
        if (!$id)
        {
            $where = ['status' => -1, 'created_by' => $this->user->get('id')];
        }
        else
        {
            $where = ['note_ids LIKE "%('. $id .')%"' ];
        }

        $notes = $this->FileEntity->listNote(0, 0, $where);
        
        return $notes;
    }
}
