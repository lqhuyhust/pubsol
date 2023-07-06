<?php
namespace Tests\version\models;

use Tests\Test as TestCase;

class VersionModelTest extends TestCase
{ 
    private $VersionModel;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $this->VersionModel = $container->get('VersionModel');
    }

    public function testGetVersion()
    {
        $try = $this->VersionModel->getVersion();
        $this->assertNotEmpty($try);
    }

    /**
     * @dataProvider dataValidate
     */
    public function testValidate($data, $result)
    {
        $try = $this->VersionModel->validate($data);
        $try = $try ? true : false;

        $this->assertEquals($try, $result);
    }

    public function dataValidate()
    {
        return [
            [[

            ], false],
            [[
               'name' => '', 
               'release_date' => '', 
            ], false],
            [[
               'name' => 'Test', 
               'release_date' => '', 
            ], true],
        ];
    }

    /**
     * @dataProvider dataAdd
     */
    public function testAdd($data, $result)
    {
        $try = $this->VersionModel->add($data);
        $try = $try ? true : false;
        
        $this->assertEquals($try, $result);
    }

    public function dataAdd()
    {
        return [
            [[

            ], false],
            [[
                'name' => 'Test Version', 
                'release_date' => null,
                'description' => '',
                'status' => 0,
            ], true],
        ];
    }

    /**
     * @dataProvider dataUpdate
     */
    public function testUpdate($data, $result)
    {
        $try = $this->VersionModel->update($data);
        $try = $try ? true : false;
        
        $this->assertEquals($try, $result);
    }

    public function dataUpdate()
    {
        return [
            [[

            ], false],
            [[
                'id' => '',
            ], false],
            [[

                'id' => 1,
                'name' => 'Test Version', 
                'release_date' => null,
                'description' => '',
                'status' => 0,
            ], true],
        ];
    }

    /**
     * @dataProvider dataRemove
     */
    public function  testRemove($id, $result)
    {
        $try = $this->VersionModel->remove($id);
        $try = $try ? true : false;
        
        $this->assertEquals($try, $result);
    }

    public function dataRemove()
    {
        return [
            [0, false],
            [2, true],
        ];
    }
}
