<?php
/**
 * SPT software - Application Instance
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Application Instance
 * 
 */

namespace App\plugins\milestone\middlewares\validation;

use SPT\Middleware\Script;
use SPT\App\Instance as AppIns;

class ValidateUser extends Script
{
    public function validate($params)
    {
        $request = AppIns::factory('request');
        $UserEntity = AppIns::factory('UserEntity');
        $session = AppIns::factory('session');

        $password = $request->post->get('password', '', 'string');
        $urlVars = $request->get('urlVars');
        $id = (int) $urlVars['id'];
        $username = $request->post->get('username', '', 'string');
        $email = $request->post->get('email', '', 'string');

        if(!empty($password)) 
        {
            $password = $password;
            if (strlen($password) < '6') 
            {
                $session->set('validate', "Error: Your Password Must Contain At Least 6 Characters!");
                return false;
            }
        } 
        elseif (!$id) 
        {
            $session->set('validate', "Error: Passwords cant't empty");
            return false;
        }

        // validate user name
        if(!empty($username)) 
        {
            $username = $username;
            $find = $UserEntity->findOne(['username' => $username]);
            if ($find && $find['id'] != $id)
            {
                $session->set('validate', "Error: Username already exists");
                return false;
            }
        } 
        else 
        {
            $session->set('validate', "Error: UserName cant't empty");
            return false;
        }

        //validate email
        if(!empty($email)) {
            $email = $email;
            $findEmail = $UserEntity->findOne(['email' => $email]);
            if ($findEmail && $findEmail['id'] != $id)
            {
                $session->set('validate', "Error: Email already exists");
                return false;
            }
        } else {
            $session->set('validate', "Error: Email can't empty");
            return false;
        }
        
        if (!$this->next) {
            return true;
        }

        return $this->next->validate($params);
    }
}