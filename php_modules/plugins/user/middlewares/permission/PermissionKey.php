<?php
/**
 * SPT software - Application Instance
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Application Instance
 * 
 */

namespace App\plugins\user\middlewares\permission;

use SPT\Middleware\Script;
use SPT\App\Instance as AppIns;

class PermissionKey extends Script
{
    public function allow($params)
    {
        if ( is_array( $params['PermissionKey'] ))
        { 
            $user = AppIns::factory('user');
            
            foreach($user->getPermissions() as $permission)
            {
                if( in_array( $permission, $params['PermissionKey']) )
                {
                    return true;
                }
            }
        }

        if (!$this->next) {
            return false;
        }

        return $this->next->allow($params);
    }
}
