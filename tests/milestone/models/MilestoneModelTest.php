<?php
namespace Tests\milestone\models;

use Tests\Test as TestCase;

class MilestoneModelTest extends TestCase
{ 
    private $MilestoneModel;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $this->MilestoneModel = $container->get('MilestoneModel');
    }

    /**
     * @dataProvider dataRemove
     * @depends testAdd
     * @depends testUpdate
     */
    public function testRemove($id, $result)
    {
        $try = $this->MilestoneModel->remove($id);
        
        $this->assertEquals($try, $result);
    }   

    /**
     * @dataProvider dataValidate
     */
    public function testValidate($data, $result)
    {
        $try = $this->MilestoneModel->validate($data);
        $try = $try ? true : false;

        $this->assertEquals($try, $result);
    }

    /**
     * @dataProvider dataAdd
     */
    public function testAdd($data, $result)
    {
        $try = $this->MilestoneModel->add($data);
        $this->assertEquals($try , $result);
    }

    /**
     * @dataProvider dataUpdate
     */
    public function testUpdate($data, $result)
    {
        $try = $this->MilestoneModel->update($data);
        $this->assertEquals($try , $result);
    }

    public function dataValidate()
    {
        return [
            [[

            ], false],
            [[
               'title' => '', 
            ], false],
            [[
               'title' => 'Test1', 
               'start_date' => null, 
               'end_date' => null, 
            ], true],
            [[
                'title' => 'Test1', 
                'id' => 1,
                'start_date' => null, 
                'end_date' => null, 
             ], true],
        ];
    }

    public function dataRemove()
    {
        return [
            [2, true],
        ];
    }

    public function dataAdd()
    {
        return [
            [[], false],
            [[
                'title' => 'Test Milestone',
                'description' => 'This is test milestone',
                'start_date' => null,
                'end_date' => null,
                'status' => 1,
            ], true],
        ];
    }

    public function dataUpdate()
    {
        return [
            [[], false],
            [[
                'title' => 'Test',
                'id' => '',
            ], false],
            [[
                'id' => 1,
                'title' => 'Test Milestone',
                'description' => 'This is test milestone',
                'start_date' => null,
                'end_date' => null,
                'status' => 1,
            ], true],
        ];
    }
}
