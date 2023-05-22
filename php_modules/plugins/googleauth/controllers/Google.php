<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace App\plugins\googleauth\controllers;

use SPT\MVC\JDIContainer\MVController;
use SPT\Middleware\Dispatcher as MW;

class Google extends MVController
{
    public function login()
    {
        $client = $this->GoogleModel->initGoogle();
        $code = $this->request->get->get('code', '', 'string');
        if ($code) {
            $token = $client->fetchAccessTokenWithAuthCode($code);
            if (!isset($token['access_token']))
            {
                $this->session->set('flashMsg', 'Login Fail');
                return $this->app->redirect($this->router->url('login'));
            }
            $client->setAccessToken($token['access_token']);
     
            // get profile info
            $google_oauth = new \Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            $email =  $google_account_info->email;
            $name =  $google_account_info->name;

           // print_r($google_account_info);
           /**
            * CHECK EMAIL AND NAME IN DATABASE
            */
            $check = $this->UserEntity->findOne(['email' => $email]);
            if (!$check)
            {
                $user_id = $this->UserEntity->add([
                    'username' => $email,
                    'email' => $email,
                    'password' => $email,
                    'name' => $name,
                    'status' => 0,
                    'created_by' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'modified_by' => 0,
                    'modified_at' => date('Y-m-d H:i:s')
                ]);
            }
            else
            {
                $user_id = $check['id'];
            }

            $user = $this->UserEntity->findOne(['id' => $user_id]);
            $storate = $this->user->getContext();
            $this->session->set($storate, $user);
            
            return $this->app->redirect($this->router->url(''));
        }
        
        return $this->app->redirect($this->router->url('login'));
    }

}