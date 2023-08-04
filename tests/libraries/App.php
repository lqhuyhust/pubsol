<?php
/**
 * SPT software - Unitest Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A web application based Joomla container
 * @version: 0.8
 * 
 */

namespace Tests\libraries;
 
use SPT\Query;
use SPT\Extend\Pdo as PdoWrapper;

use DTM\core\libraries\SDM as Base;

class App extends Base
{
    private function prepareDb()
    {
        try{
            $pdo = new PdoWrapper( $this->config->db_test );
            if(!$pdo->connected)
            {
                throw new \Exception('Connection failed.', 500); 
            }

            $this->container->set('query', new Query( $pdo, ['#__'=>  $this->config->db_test['prefix']]));
        } 
        catch(\Exception $e) 
        {
            $this->raiseError( $e->getMessage() );
        }
    }
}