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
            return false;
        }

        $note = $this->Note2Entity->findByPK($id);
        if (!$note)
        {
            return [];
        }

        $file = $this->FileEntity->findOne(['note_id' => $id]);
        $note['path'] = $file ? $file['path'] : '';
        $note['file_type'] = $file ? $file['file_type'] : '';

        return $note;
    }

    public function validate($data, $is_update = false)
    {
        if (!$data || !is_array($data))
        {
            $this->error = 'Error: Invalid data format.';
            return false;
        }

        if (!$data['title'])
        {
            $this->error = 'Error: Title can\'t empty.';
            return false;
        }

        if (!$is_update)
        {
            if (!isset($data['file']) || !$data['file'] || !$data['file']['name'])
            {
                $this->error = 'Invalid File Upload';
                return false;
            }

            if ($this->config->exists('extensionAllow') && $this->config->extensionAllow &&  is_array($this->config->extensionAllow)) 
            {
                $extension = explode('.', $data['file']['name']);
                $extension = end($extension);
                if (!in_array($extension, $this->config->extensionAllow)) 
                {
                    $this->error = 'File are not allowed to upload';
                    return false;
                }
            }
        }

        return true;
    }

    public function getCurrentId()
    {
        $params = $this->request->get('urlVars');
        $id = $params['id'] ?? 0;
        return (int) $id;
    }

    public function add($data)
    {
        if (!$this->validate($data))
        {
            return false;
        }

        $file_name = $this->upload($data['file']);
        if (!$file_name)
        {
            $this->error = 'Upload Failed';
            return false;
        }

        $newId =  $this->Note2Entity->add([
            'title' => $data['title'],
            'public_id' => '',
            'alias' => '',
            'data' => '',
            'tags' => '',
            'type' => 'file',
            'parent_id' => 0,
            'notice' => isset($data['notice']) ? $data['notice'] : '',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->user->get('id'),
            'locked_at' => date('Y-m-d H:i:s'),
            'locked_by' => $this->user->get('id'),
        ]);

        if ($newId)
        {
            $file_type = explode('.', $file_name);
            $file_type = strtolower(end($file_type));

            $try = $this->FileEntity->add([
                'note_id' => $newId,
                'path' => 'media/attachments/' . date('Y/m/d'). '/'. $file_name,
                'file_type' => $file_type,
            ]);

            if (!$try)
            {
                $this->error = 'Error: Can\'t create the record.';
                return false;
            }
        }

        return $newId;
    }

    public function update($data)
    {
        if (!$this->validate($data, true) || empty($data['id']))
        {
            return false;
        }
        
        $try = $this->Note2Entity->update([
            'title' => $data['title'],
            'notice' => isset($data['notice']) ? $data['notice'] : '',
            'id' => $data['id'],
        ]);

        if (!$try)
        {
            $this->error = 'Error: Can\'t update the record.';
        }

        return $try;
    }

    public function upload($file)
    {
        if($file && $file['name']) 
        {
            // get folder save attachment
            $path_attachment = $this->createFolderSave();

            $uploader = $this->file->setOptions([
                'overwrite' => true,
                'targetDir' => $path_attachment
            ]);
    
            // TODO: create dynamice fieldName for file
            $index = 0;
            $tmp_name = $file['name'];
            while(file_exists($path_attachment. '/' . $file['name']))
            {
                $file['name'] = $index. "_". $tmp_name;
                $index ++;
            }
            
            if( false === $uploader->upload($file) )
            {
                $this->error = 'Invalid attachment';
                return false;
            }
            
            return $file['name'];
        }

        return false;
    }

    public function remove($id)
    {
        if (!$id)
        {
            return false;
        }

        $file = $this->FileEntity->findOne(['note_id' => $id]);
        if ($file)
        {
            $this->FileEntity->remove($file['id']);
        }

        $try = $this->Note2Entity->remove($id);
        return $try;
    }

    public function createFolderSave($dir = '')
    {
        if (!$dir) {
            $dir = MEDIA_PATH ;
        }

        foreach (['attachments', date('Y'), date('m'), date('d')] as $item) 
        {
            $dir .= '/' . $item;

            if (!is_dir($dir) && !mkdir($dir)) 
            {
                return '';
            }
        }
        return $dir;
    }
}
