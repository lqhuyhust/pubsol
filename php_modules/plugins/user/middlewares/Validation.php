<?php
/**
 * SPT software - Middleware Instance
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Middleware Instance
 * 
 */

namespace App\plugins\user\middlewares;

use SPT\Middleware\Loader; 
use SPT\App\Instance as AppIns;

class Validation extends Loader
{
    public function __construct( $path = '', $func = 'validate' )
    {
        $this->func = $func;
        $this->namespace = AppIns::main()->getName($path);
    }
}