<?php
namespace Tests\milestone\models;

use Tests\Test as TestCase;

class RequestModelTest extends TestCase
{ 
    private $RequestModel;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $this->RequestModel = $container->get('RequestModel');
    }

    /**
     * @dataProvider dataRemove
     * @depends testAdd
     * @depends testUpdate
     */
    public function testRemove($id, $result)
    {
        $try = $this->RequestModel->remove($id);
        
        $this->assertEquals($try, $result);
    }   

    /**
     * @dataProvider dataValidate
     */
    public function testValidate($data, $result)
    {
        $try = $this->RequestModel->validate($data);
        $try = $try ? true : false;

        $this->assertEquals($try, $result);
    }

    /**
     * @dataProvider dataAdd
     */
    public function testAdd($data, $result)
    {
        $try = $this->RequestModel->add($data);
        $this->assertEquals($try , $result);
    }

    /**
     * @dataProvider dataUpdate
     */
    public function testUpdate($data, $result)
    {
        $try = $this->RequestModel->update($data);
        $this->assertEquals($try , $result);
    }

    public function dataValidate()
    {
        return [
            [[

            ], false],
            [[
               'title' => '', 
               'milestone_id' => '', 
            ], false],
            [[
               'title' => 'Test Request', 
               'milestone_id' => '', 
            ], false],
            [[
                'title' => 'Test Request', 
                'milestone_id' => -1, 
                'tags' => '', 
                'start_at' => null, 
                'assignment' => null, 
                'finished_at' => null, 
            ], false],
            [[
                'title' => 'Test Request', 
                'milestone_id' => 1, 
                'tags' => '', 
                'start_at' => null, 
                'assignment' => null, 
                'finished_at' => null, 
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
                'milestone_id' => 1,
                'title' => 'Test Request',
                'tags' => '',
                'assignment' => '',
                'description' => 'This is Test Request',
                'start_at' => null,
                'finished_at' => null,
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
                'milestone_id' => 1,
                'title' => 'Test Request',
                'tags' => '',
                'assignment' => '',
                'description' => 'This is Test Request',
                'start_at' => null,
                'finished_at' => null,
            ], true],
        ];
    }

    /**
     * @dataProvider dataGetTag
     */
    public function testGetTag($data, $result)
    {
        $try = $this->RequestModel->getTag($data);
        
        $this->assertEquals($try, $result);
    } 

    public function dataGetTag()
    {
        return [
            ['1,2', '1,2'],
            ['', ''],
        ];
    }

    public function excerpt()
    {
        $try = $this->RequestModel->excerpt('Example Text');
        $this->assertIsString($try);
    }

    /**
     * @dataProvider dataGetVersionNote
     */
    public function testGetVersionNote($data, $result)
    {
        $try = $this->RequestModel->getVersionNote($data);
        
        $try = is_array($try) ? true : false;
        $this->assertEquals($try, $result);
    }

    public function dataGetVersionNote()
    {
        return [
            [0, false],
            [1, true],
        ];
    }

    /**
     * @dataProvider dataRemoveVersion
     */
    public function testRemoveVersion($data, $result)
    {
        $try = $this->RequestModel->removeVersion($data);

        $this->assertEquals($try, $result);
    }

    public function dataRemoveVersion()
    {
        return [
            [2, true],
            ['', false],
        ];
    }

}
