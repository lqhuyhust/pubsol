<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\report\models;

use SPT\Container\Client as Base;

class ReportModel extends Base
{ 
    // Write your code here
    public function getTypes()
    {
        $app = $this->container->get('app');
        $types = [];
        $app->plgLoad('report', 'registerType', function($type) use (&$types)
        {
            if (is_array($type) && $type)
            {
                $types = array_merge($type, $types);
            }
        });

        return $types;
    }
}
