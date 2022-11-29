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

class appPlg extends CMSApp
{
    public function getName(string $extra='')
    {
        return 'App\\'. $extra;
    }

    public function prepareUser()
    {
        // write your code here
    }
}
