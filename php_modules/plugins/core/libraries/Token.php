<?php
namespace App\plugins\core\libraries;

use SPT\Application\IApp;
use SPT\Support\Token as SupportToken;
use SPT\Support\Env;

class Token
{
    public function __construct( IApp $app)
    {
        $this->container = $app->getContainer();
        $this->config = $this->container->get('config');
        $this->request = $this->container->get('request');
        $this->getToken();
    }

    public function getToken(string $context = '_app_')
    {
        if('_secrect_' === $context)
        {
            return empty($this->config->exists('secrect')) ? strtotime('now') : $this->config->secrect;
        }

        $res = '';

        if( !$this->container->exists('secrects') )
        {
            $res = $this->createToken($context);
            $this->container->set('secrects', [ $context => $res]);
        } 
        else
        {
            $secrects = $this->container->get('secrects');
            if(!isset($secrects[$context]))
            {
                $secrects[$context] = $this->createToken($context);
            }
            $res = $secrects[$context];
        }

        return $res;
    }

    protected function createToken(string $context)
    {
        $browser = $this->request->server->get('HTTP_USER_AGENT', '');
        $secrect = $this->getToken('_secrect_');

        $cookie = $this->request->cookie->get($secrect, '_do_not_set_');
        if ('_do_not_set_' == $cookie)
        {
            $cookie = SupportToken::md5( rand(199999, strtotime('now')), 8);
            $this->request->cookie->set($secrect, $cookie);
        }

        return SupportToken::md5(
            SupportToken::md5($context, 4). Env::getClientIp(). $browser. $cookie
        );
    }
}