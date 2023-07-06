<?php
namespace Tests\milestone\models;

use Tests\Test as TestCase;

class DiscussionModelTest extends TestCase
{ 
    private $DiscussionModel;
    
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $this->DiscussionModel = $container->get('DiscussionModel');
    }

    /**
     * @dataProvider dataValidate
     */
    public function testValidate($data, $result)
    {
        $try = $this->DiscussionModel->validate($data);
        $try = $try ? true : false;

        $this->assertEquals($try, $result);
    }

    /**
     * @dataProvider dataAdd
     */
    public function testAdd($data, $result)
    {
        $try = $this->DiscussionModel->add($data);
        $this->assertEquals($try , $result);
    }

    public function dataValidate()
    {
        return [
            [[
                'request_id' => '',
            ], false],
            [[], false],
            [[
               'request_id' => 1, 
               'message' => '', 
            ], false],
            [[
                'request_id' => 1, 
                'message' => 'Test Message', 
                'document_id' => 1, 
            ], true],
        ];
    }

    public function dataAdd()
    {
        return [
            [[], false],
            [[
                'document_id' => '',
                'message' => '',
            ], false],
            [[
                'document_id' => 1,
                'message' => '',
            ], true],
        ];
    }
}
