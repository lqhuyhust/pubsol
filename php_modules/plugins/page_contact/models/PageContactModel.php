<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\page_contact\models;

use SPT\Container\Client as Base;
use SPT\Traits\ErrorString;

class PageContactModel extends Base
{ 
    use ErrorString; 

    // Write your code here
    public function remove($id)
    {
        if (!$id)
        {
            return false;
        }

        return $this->PageEntity->remove($id);
    }

    public function validate($data)
    {
        if (!$data || !is_array($data))
        {
            return false;
        }

        if (!$data['title'])
        {
            $this->error = 'Title can\'t empty! ';
            return false;
        }

        if ($data['slug'])
        {
            if (!preg_match('/^[a-z0-9-]+$/', $data['slug'])) {
                $this->error = 'Slug invalid format!';
                return false;
            }
            
            $where = ['slug' => $data['slug']];
            if (isset($data['id']))
            {
                $where[] = 'id <> '.$data['id'];
            }

            $find = $this->PageEntity->findOne($where);
            if ($find)
            {
                $this->error = 'Slug already used! ';
                return false;
            }
        }

        return $data;
    }

    public function add($data)
    {
        $try = $this->validate($data);
        if (!$try)
        {
            return false;
        }

        if(!$data['slug'])
        {
            $data['slug'] = $this->PageModel->generateSlug($data['title']);
        }

        $newId =  $this->PageEntity->add([
            'title' => $data['title'],
            'template_id' => $data['template_id'],
            'slug' => $data['slug'],
            'permission' => '',
            'data' => $data['data'],
            'page_type' => 'contact',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->user->get('id'),
            'locked_at' => date('Y-m-d H:i:s'),
            'locked_by' => $this->user->get('id'),
        ]);

        return $newId;
    }

    public function update($data)
    {
        $try = $this->validate($data);
        if (!$try || !isset($data['id']) || !$data['id'])
        {
            return false;
        }

        $try = $this->PageEntity->update([
            'title' => $data['title'],
            'template_id' => $data['template_id'],
            'slug' => $data['slug'],
            'data' => $data['data'],
            'id' => $data['id'],
        ]);

        return $try;
    }

    public function send($data)
    {
        $admin_mail = $this->OptionModel->get('admin_mail', '');
        if (!$admin_mail)
        {
            $this->error = 'Invalid admin mail';
        }
        
        $body = 'Full Name '. $data['full-name']. '
        Email: '. $data['email']. '
        Message: '. $data['message']. '
        '; 
        
        $try = $this->EmailModel->send($admin_mail, 'administrator', $body, 'Contact Mail' );
        if (!$try)
        {
            $this->error = "Can't send mail to admin";
            return false;
        }

        return true;
    }
}
