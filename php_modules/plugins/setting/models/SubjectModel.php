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

class SubjectModel extends Base 
{ 
    // Write your code here
    public function validate($data, $id = false)
    {
        $err_msg = [];
        $err_flg = false;

        if (strlen($data['sub_name']) == 0)
        {
            $err_msg[] = 'A Subject Name MUST be specified!';
            $err_flg = true;
        }

        if (strlen($data['sub_text1']) == 0)
        {
            $err_msg[] = 'A Subject Text MUST be specified!';
            $err_flg = true;
        }

        $where_check = $id ? ['sub_name' => $data['sub_name'] , 'sub_id NOT LIKE "'. $id .'"'] : ['sub_name' => $data['sub_name']];
        $name_check = $this->SubEntity->findOne($where_check);
        if ($name_check)
        {
            $err_msg[] = 'A subject named ' . $data['sub_name'] . ' is already in system!';
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

    public function updateImage($count, $id)
    {
        $uploadsound = PUBLIC_PATH. "media/sound/";
        for ($i = 1; $i <= $count; $i++)
        {
            $del_label = "del_img_" . $i;
            $info_id_label = "info_id_" . $i;
            $old_image_label = "info_image_" . $i;
            $old_sound_label = "info_sound_" . $i;
            $image_label = "sub_image_" . $i;
            $sound_label = "sub_sound_" . $i;
            $remove_sound_label = "remove_sound_" . $i;
            $sub_txt_label = "sub_txt_" . $i;
            $image_sort_label = "image_sort_" . $i;

            $del_value = trim($this->request->post->get($del_label, '', 'string'));
            $info_id = trim($this->request->post->get($info_id_label, '', 'string'));
            $old_sound_value = trim($this->request->post->get($old_sound_label, '', 'string'));
            $old_image_value = trim($this->request->post->get($old_image_label, '', 'string'));
            $sub_txt_value = stripslashes(trim($this->request->post->get($sub_txt_label, '', 'string')));
            $image_sort_value = trim($this->request->post->get($image_sort_label, '99', 'string'));
            $remove_sound_value = trim($this->request->post->get($remove_sound_label, '', 'string'));
            $image_file = $old_image_value;
	        $sound_file = $old_sound_value;
            $data_entered = "Y";
            if ($info_id == "NEW")
            {
                $file_image = $this->request->file->get($image_label, [], 'array');
                if ($file_image['tmp_name'])
                {
                    $data_entered = "Y";
                }
                else
                {
                    $data_entered = "N";
                }
            }

            if ($data_entered == "Y")
            {
                if ($del_value == "on")
                {
                    $pic_t = PUBLIC_PATH. "media/images2/" . $old_image_value;
                    if (is_file($pic_t))
                    {
                        unlink($pic_t);
                    }

                    $pic_t = PUBLIC_PATH. "media/sound/" . $old_sound_value;
                    if (is_file($pic_t))
                        {
                        unlink($pic_t);
                        }
                    $this->SubImageEntity->remove($info_id);
                }
                else
                {
                    if ($info_id == "NEW")
                    {
                        $try = $this->SubImageEntity->add([
                            'subject_id' =>  $id,
                            'sort_order' => (int) $image_sort_value,
                            'info_text' =>  $sub_txt_value,
                            'info_image' => "default_100.jpg",
                            'info_sound' => 'None',
                        ]);
                        $info_id = $try ? $try : $info_id;
                    }
                    
                    $sub_sound = $this->request->file->get($sound_label, [], 'array');
                    if ($sub_sound['tmp_name'])
                    {
                        $temp = pathinfo($sub_sound['name']);
                        $ext = strtolower($temp['extension']);
                        $sound_file = "sub_" . $id . "_sound_" .  $info_id . "." . $ext;
                        $this->HelperModel->uploadFile($sub_sound, $sound_file, PUBLIC_PATH.'media/sound');
                    }
                    if ($remove_sound_value == "Yes")
                    {
                        $pic_t = $uploadsound . $old_sound_value;
                        if (is_file($pic_t))
                        {
                            unlink($pic_t);
                            //	echo "<br>Line #: " .  __LINE__ . " delete sound file: *$pic_t*\n";
                        }
                    }
                    
                    $sub_img = $this->request->file->get($image_label, [], 'array');
                    if ($sub_img['tmp_name'])
                    {
                        $temp = pathinfo($sub_img['name']);
                        $ext = strtolower($temp['extension']);
                        $image_file = "sub_" . $id . "_img_" . $info_id . "." . $ext;
                        $this->HelperModel->uploadFile($sub_img, $image_file, PUBLIC_PATH.'media/images2');
                    }
                    
                    $try = $this->SubImageEntity->update([
                        'sort_order' => (int) $image_sort_value,
                        'info_text' => $sub_txt_value,
                        'info_image' => $image_file,
                        'info_sound' => $sound_file,
                        'id' => $info_id,
                    ]);
                }
            }
        }
    }

    public function updateFact($count, $id)
    {
        for ($i = 1; $i <= $count; $i++) 
        {
            $del_label = "del_fact_" . $i;
            $fact_id_label = "fact_id_" . $i;
            $name_label = "fact_name_" . $i;
            $value_label = "fact_value_" . $i;
            $sort_label = "fact_sort_" . $i;
            $s_link_label = "fact_s_link_" . $i;
    
            $del_value = trim($this->request->post->get($del_label, '', 'string'));
            $fact_id = trim($this->request->post->get($fact_id_label, '', 'string'));
            $name_value = stripslashes(trim($this->request->post->get($name_label, '', 'string')));
            $value_value = stripslashes(trim($this->request->post->get($value_label, '', 'string')));
            $sort_value = trim($this->request->post->get($sort_label, '', 'string'));
            $s_link_id_value = trim($this->request->post->get($s_link_label, '', 'string'));

            if ($fact_id == "NEW")
            {
                if (strlen($name_value) != "" )
                {
                    $new_id = $this->SubFactEntity->add([
                        'subject_id' => $id,
                        'sort_order' => (int) $sort_value,
                        'name' => $name_value,
                        'value' => $value_value,
                        's_link_id' => $s_link_id_value,
                    ]);
                }
                else
                {
                }
            }
            else		// update entry
            {
                if (strlen($name_value) == 0 | $name_value == "None")
                {
                    $this->SubFactEntity->remove($fact_id);
                }
                else
                {
                    $try = $this->SubFactEntity->update([
                        'subject_id' => $id,
                        'sort_order' => (int) $sort_value,
                        'name' => $name_value,
                        'value' => $value_value,
                        's_link_id' => $s_link_id_value,
                        'id' => $fact_id,
                    ]);
                }
            }
        }
    }

    public function updateTopics($topics, $id)
    {
        $current_topics = $this->TopSubEntity->listTopic(0, 0, $id);
        foreach($topics as $item)
        {
            $try = $this->TopSubEntity->findOne(['topic_id' => $item, 'subject_id' => $id]);
            if (!$try)
            {
                $result = $this->TopSubEntity->add(['topic_id' => $item, 'subject_id' => $id]);
                if ($result === false)
                {
                    return false;
                }
            }
        }

        // remove topics
        foreach($current_topics as $item)
        {
            if (!in_array($item['topic_id'], $topics))
            {
                $result = $this->TopSubEntity->remove($item['topic_id'], $id);
                if (!$result)
                {
                    return false;
                }
            }
            
        }
        return true;
    }
}
