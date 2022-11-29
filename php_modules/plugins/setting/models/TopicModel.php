<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\facts4me\models;

use SPT\JDIContainer\Base; 

class TopicModel extends Base 
{ 
    // Write your code here
    public function validate($data, $id = false)
    {
        $err_msg = [];
        $err_flg = false;
        
        if (strlen($data['topic_name']) == 0)
        {
            $err_msg[]= 'A Topic Name MUST be specified!';
            $err_flg = true;
        }

        $where_check = $id ? ['topic_name' => $data['topic_name'] , 'topic_id NOT LIKE "'. $id .'"'] : ['topic_name' => $data['topic_name']];
        $name_check = $this->TopicEntity->findOne([$where_check]);
        if ($name_check)
        {
            $err_msg[]= 'A Topic Name (' . $data['topic_name'] . ') already in use!';
            $err_flg = true;
        }

        if ($err_flg)
        {
            return [
                'err_flg' => $err_flg,
                'err_msg' => $err_msg,
    
            ];
        }
        
        return $data;
    }

    public function uploadImage($file, $id)
    {
        $uploader = $this->file->setOptions([
            'overwrite' => true,
            'newName' => "topic_" . $id . "_text.jpg",
            'targetDir' => PUBLIC_PATH.'media/images1',
        ]);
        $try = $uploader->upload($file);
        
        return $try;
    }
}
