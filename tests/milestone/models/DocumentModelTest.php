<?php
namespace Tests\milestone\models;

use Tests\Test as TestCase;

class DocumentModelTest extends TestCase
{ 
    private $DocumentModel;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $this->DocumentModel = $container->get('DocumentModel');
    }

    /**
     * @dataProvider dataSave
     */
    public function testSave($data, $result)
    {
        $try = $this->DocumentModel->save($data);
        $try = $try ? true : false;

        $this->assertEquals($try, $result);
    }

    /**
     * @dataProvider dataRemove
     */
    public function testRemove($data, $result)
    {
        $try = $this->DocumentModel->remove($data);
        $this->assertEquals($try , $result);
    }

    public function dataSave()
    {
        return [
            [[], false],
            [[
                'request_id' => '',
            ], false],
            [[
                'request_id' => 1,
                'description' => '',
            ], true],
            [[
                'request_id' => 1,
                'description' => 'This is description',
            ], true],
        ];
    }

    public function dataRemove()
    {
        return [
            [2, true],
        ];
    }

    /**
     * @dataProvider dataGetHistory
     */
    public function testGetHistory($data, $result)
    {
        $try = $this->DocumentModel->getHistory($data);
        $try = $try ? true : false;

        $this->assertEquals($try, $result);
    }

    public function dataGetHistory()
    {
        return [
            [0, false],
            [1, true],
        ];
    }

    /**
     * @dataProvider dataGetComment
     */
    public function testGetComment($data, $result)
    {
        $try = $this->DocumentModel->getComment($data);
        $try = $try ? true : false;

        $this->assertEquals($try, $result);
    }

    public function dataGetComment()
    {
        return [
            [0, false],
            [1, true],
        ];
    }

    /**
     * @dataProvider dataRollBack
     */
    public function testRollBack($data, $result)
    {
        $try = $this->DocumentModel->rollback($data);
        $try = $try ? true : false;

        $this->assertEquals($try, $result);
    }

    public function dataRollBack()
    {
        return [
            [0, false],
            [1, true],
        ];
    }
}
