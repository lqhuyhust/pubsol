<?php
namespace Tests\ready;

use Tests\Test as TestCase;

class ConfigFileTest extends TestCase
{

    public function testConfig()
    {
        $config_file = __DIR__.'/../config.php';
        if( !file_exists( $config_file ))
        {
            throw new \Exception('Config file has not been created.');
        }

        $this->assertTrue(true);
    }
}