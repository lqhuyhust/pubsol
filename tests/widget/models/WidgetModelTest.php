<?php
namespace Tests\widget\models;

use Tests\Test as TestCase;

class WidgetModelTest extends TestCase
{ 
    private $WidgetModel;
    static $data;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $app->set('mainPlugin', ['name' => 'page']);
        $container->get('request')->set('urlVars', ['id' => 1]);
        $this->WidgetModel = $container->get('WidgetModel');
    } 

    public function testGetTypes()
    {
        $try = $this->WidgetModel->getTypes();
        $this->assertIsArray($try);
    }

    public function testGetWidgetByPosition()
    {
        $try = $this->WidgetModel->getWidgetByPosition(1, 'top');
        $this->assertIsArray($try);
    }

     /**
     * @dataProvider dataGetWidgetByTemplate
     */
    public function testGetWidgetByTemplate($id, $result)
    {
        $try = $this->WidgetModel->getWidgetByTemplate($id);
        $try = is_array($try) ? true : false;
        $this->assertEquals($try, $result);
    } 

    public function dataGetWidgetByTemplate()
    {
        return [
            [1, true],
        ];
    } 

    /** 
    * @dataProvider dataRemoveByTemplate
     */
    public function testRemoveByTemplate($id, $result)
    {
        $try = $this->WidgetModel->removeByTemplate($id);
        $this->assertEquals($try, $result);
    } 

    public function dataRemoveByTemplate()
    {
        return [
            [0, false],
            [1, true],
        ];
    } 

    public function testSearch()
    {
        $try = $this->WidgetModel->search('t', 'top');
        $this->assertIsArray($try);
    } 

    public function testConvertPosition()
    {
        $try = $this->WidgetModel->convertPosition(['top']);
        $this->assertIsArray($try);
    }
}
