<?php
namespace Tests\template\models;

use Tests\Test as TestCase;

class TemplateModelTest extends TestCase
{ 
    private $TemplateModel;
    static $data;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $app->set('mainPlugin', ['name' => 'page']);
        $container->get('request')->set('urlVars', ['id' => 1]);
        $app->set('themePath', APP_PATH .'themes');
        $this->TemplateModel = $container->get('TemplateModel');
        $TemplateEntity = $container->get('TemplateEntity');

        if (!static::$data)
        {
            $find = $TemplateEntity->findByPK(2);
            if(!$find)
            {
                $TemplateEntity->add([
                    'title' => 'test',
                    'id' => 2,
                    'fnc' => '',
                    'positions' => '',
                    'status' => 1,
                    'note' => '',
                    'path' => 'blue/front',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 0,
                    'locked_at' => date('Y-m-d H:i:s'),
                    'locked_by' => 0,
                ]);
            }
            static::$data = true;
        }
    } 

    public function testGetPathList()
    {
        $try = $this->TemplateModel->getPathList();
        $this->assertIsArray($try);
    }

    /**
     * @dataProvider dataGetWidgets
     */
    public function testGetWidgets($id, $result)
    {
        $try = $this->TemplateModel->getWidgets($id);
        $try = is_array($try) ? true : false;
        $this->assertEquals($try, $result);
    }

    public function dataGetWidgets()
    {
        return [
            [0, false],
            [1, true],
        ];
    } 

    public function testNew()
    {
        $try = $this->TemplateModel->new();
        $this->assertIsArray($try);
    }

    /**
     * @dataProvider dataRemove
     * @depends testUpdate
     */
    public function testRemove($id, $result)
    {
        $try = $this->TemplateModel->remove($id);
        
        $this->assertEquals($try, $result);
    } 

    public function dataRemove()
    {
        return [
            [0, false],
            [2, true],
        ];
    }

    /**
     * @dataProvider dataValidate
     */
    public function testValidate($data, $result)
    {
        $try = $this->TemplateModel->validate($data);
        $try = is_array($try) ? true : false;
        $this->assertEquals($try, $result);
    }

    public function dataValidate()
    {
        return [
            [[], false],
            [
                ['title' => ''], false
            ],
            [
                ['title' => 'test contact',
                'path' => 'blue/front'], true
            ],
        ];
    }

    /**
     * @dataProvider dataUpdate
     */
    public function testUpdate($data, $result)
    {
        $try = $this->TemplateModel->update($data);
        $this->assertEquals($try, $result);
    }

    public function dataUpdate()
    {
        return [
            // [[], false],
            // [
            //     ['title' => ''], false
            // ],
            [
                ['title' => 'test contact',
                'path' => 'blue/front',
                'note' => '',
                'id' => 2,], true
            ],
        ];
    }

    public function testGetWidgetPosition()
    {
        $try = $this->TemplateModel->getWidgetPosition(2);
        $this->assertIsArray($try);
    }
}
