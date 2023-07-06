<?php
namespace Tests\tag\models;

use Tests\Test as TestCase;

class TagModelTest extends TestCase
{ 
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $this->TagModel = $container->get('TagModel');
    }

    /**
     * @dataProvider dataRemove
     * @depends testAdd
     * @depends testUpdate
     */
    public function testRemove($id, $result)
    {
        $try = $this->TagModel->remove($id);
        $this->assertEquals($try, $result);
    }

    public function dataRemove()
    {
        return [
            [2, true],
            [3, true],
        ];
    }

    /**
     * @dataProvider dataValidate
     */
    public function testValidate($data, $result)
    {
        $try = $this->TagModel->validate($data);
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
            ], false],
            [[
               'name' => 'Test', 
            ], true],
        ];
    }

    /**
     * @dataProvider dataAdd
     */
    public function testAdd($data, $result)
    {
        $try = $this->TagModel->add($data);
        $try = $try ? true : false;
        
        $this->assertEquals($try, $result);
    }

    public function dataAdd()
    {
        return [
            [[

            ], false],
            [[
               'name' => 'Test Tag', 
               'description' => '', 
               'parent_id' => 0, 
            ], true],
        ];
    }

    /**
     * @dataProvider dataUpdate
     */
    public function testUpdate($data, $result)
    {
        $try = $this->TagModel->update($data);
        $this->assertEquals($try, $result);
    }

    public function dataUpdate()
    {
        return [
            [[

            ], false],
            [[
                'name' => 'Test Tag Update', 
                'description' => '', 
                'id' => '',
                'parent_id' => 0, 
            ], false],
            [[
               'name' => 'Test Tag Update', 
               'description' => '', 
               'parent_id' => 0, 
               'id' => 1,
            ], true],
        ];
    }

    /**
     * @dataProvider dataSearch
     */
    public function testSearch($search, $ignores)
    {
        $try = $this->TagModel->search($search, $ignores);
        $this->assertIsArray($try);
    }

    public function dataSearch()
    {
        return [
            ['', ''],
            ['test', ''],
            ['test', []],
            ['test', ['1']],
        ];
    }
}
