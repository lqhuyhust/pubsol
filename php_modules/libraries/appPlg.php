<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic Application implement mvc
 * 
 */

namespace App\libraries; 

use SPT\App\JDIContainer\CMSApp; 
use SPT\User\Instance as User;
use SPT\User\SPT\User as UserAdapter;
use App\plugins\user\entities\UserEntity;

class appPlg extends CMSApp
{
    public function getName(string $extra='')
    {
        return 'App\\'. $extra;
    }

    public function prepareUser()
    {
        $user = new User( new UserAdapter() );
        $user->init([
            'session' => $this->session,
            'entity' => new  UserEntity($this->query)
        ]);
        $this->getContainer()->share('user', $user, true);
    }
}
