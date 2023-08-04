<?php
namespace Tests\template\viewmodels;

use App\plugins\template\viewmodels\AdminTemplates;
use SPT\Web\Gui\Listing;
use Tests\Test as TestCase;

class AdminTemplatesTest extends TestCase
{
    private $AdminTemplates;
    
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $app->set('themePath', APP_PATH .'themes');
        $request->set('urlVars', ['id' => 1]);

        $this->AdminTemplates = new AdminTemplates($container);
    }
    public function testList()
    {
        $try = $this->AdminTemplates->list();
        $this->assertIsArray($try);
    }

    public function testGetColumns()
    {
        $try = $this->AdminTemplates->getColumns();
        $this->assertIsArray($try);
    }

    public function testFilter()
    {
        $try = $this->AdminTemplates->filter();
        $this->assertIsArray($try);
    }

    public function testGetFilterFields()
    {
        $try = $this->AdminTemplates->getFilterFields();
        $this->assertIsArray($try);
    }

    public function testRow()
    {
        $list = new Listing(['item'], 1, 1, []);
        $try = $this->AdminTemplates->row([], ['list' => $list]);
        $this->assertIsArray($try);
    }
}
