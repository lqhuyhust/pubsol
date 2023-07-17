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

    public function add($data, $id)
    {
        if (!$data || !is_array($data) || !count($data['name']))
        {
            $this->error = 'Invalid File Upload!';
            return false;
        }

        $files = [];
        for ($i=0; $i < count($data['name']); $i++) 
        { 
            $files[] = [
                'name' => $data['name'][$i],
                'full_path' => $data['full_path'][$i],
                'type' => $data['type'][$i],
                'tmp_name' => $data['tmp_name'][$i],
                'error' => $data['error'][$i],
                'size' => $data['size'][$i],
            ];
        }

        if(!$files)
        {
            $this->error = 'Invalid File Upload!';
            return false;
        }

        foreach($files as $file)
        {
            $data = [
                'file' => $file, 
                'status' => $id ? 1 : -1,
                'title' => $file['name'],
                'note_ids' => '('. $id. ')',
            ];

            $try = $this->NoteFileModel->add($data);
            if (!$try)
            {
                $this->error = $this->NoteFileModel->getError();
                return false;
            }
        }

        return true;
    }
}
