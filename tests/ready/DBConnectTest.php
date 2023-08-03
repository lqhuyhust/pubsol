<?php
namespace Tests\ready;

use Tests\Test as TestCase;
use SPT\Application\Configuration;
use SPT\Extend\Pdo as PdoWrapper;
use SPT\Support\Loader;

class DBConnectTest extends TestCase
{
    public function testDB()
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $config = $container->get('config');
        $pdo = new PdoWrapper(
            $config->db,
        );

        $try = $pdo->connected ? true : false;
        if (!$try)
        {
            throw new \Exception( 'Incorrect database connection.');
        }

        $this->assertTrue($try);
    }

    public function testEntity()
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $plgList = $app->plugin(true);
        
        foreach($plgList as $plg)
        {
            Loader::findClass( 
                $plg['path']. '/entities', 
                $plg['namespace']. '\entities', 
                function($classname, $fullname) use ($container, &$entities)
                {
                    if ($container->exists($classname))
                    {
                        $entity = $container->get($classname);
                        $try = $entity->checkAvailability();
                        $this->assertNotFalse($try);
                    }
            });
        }
    }

}