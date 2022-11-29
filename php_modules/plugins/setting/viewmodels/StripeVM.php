<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */
namespace App\plugins\facts4me\viewmodels; 

use SPT\View\VM\JDIContainer\ViewModel; 

class StripeVM extends ViewModel
{
    protected $alias = '';
    protected $layouts = [
        'layouts.admin' => [
            'stripe',
        ]
    ];

    public function stripe()
    {
        $publish_key = $this->OptionModel->get('stripe_publish_key', '');
        $secret_key = $this->OptionModel->get('stripe_secret_key', '');
        
        $err_flg = $this->session->get('err_flg', '');
        $err_msg = $this->session->get('err_msg', '');
        
        $this->session->set('err_flg', '');
        $this->session->set('err_msg', '');

        if (!$this->user->get('u_id'))
        {
            $uid = 'visitor';
            $u_type = 'view';
            $expire_date = '';
        }
        else
        {
            $uid = $this->user->get('userid');
            $u_type = $this->user->get('u_type');
        }

        $this->set('err_flg', $err_flg, true);
        $this->set('err_msg', $err_msg, true);
        $this->set('bg_color', '#339933', true);
        $this->set('u_id', $this->user->get('u_id'), true);
        $this->set('token', $this->app->getToken(), true);
        $this->set('secret_key', $secret_key);
        $this->set('publish_key', $publish_key);
        $this->set('uid', $uid, true);
        $this->set('u_type', $u_type, true);
        $this->set('url', $this->router->url(), true);
    }
}
