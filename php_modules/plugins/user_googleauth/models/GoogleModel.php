<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace DTM\plugins\user_googleauth\models;

use SPT\Container\Client as Base;

class GoogleModel extends Base 
{ 
    // Write your code here
    public function getUrlLogin()
    {
        $client = $this->initGoogle();
        if ($client)
        {
            $url = $client->createAuthUrl();

            return $url;
        }
        
        return '';
    }

    public function initGoogle()
    {
        $client = new \Google_Client();
        $google_client_id = $this->OptionModel->get('google_client_id');
        $google_client_secrect = $this->OptionModel->get('google_client_secrect');
        if ($google_client_id && $google_client_secrect)
        {
            $client->setClientId($google_client_id);
            $client->setClientSecret($google_client_secrect);
            $client->setRedirectUri($this->router->url('loginGoogle'));
            $client->addScope("email");
            $client->addScope("profile");
                
        }
        else{
            return false;
        }
        
        return $client;
    }
}
