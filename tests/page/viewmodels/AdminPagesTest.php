<?php
namespace Tests\page\viewmodels;

use App\plugins\page\viewmodels\AdminPages;
use SPT\Web\Gui\Listing;
use Tests\Test as TestCase;

class AdminPagesTest extends TestCase
{
    private $AdminPages;
    
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $request->set('urlVars', ['request_id' => 1]);

        $this->AdminPages = new AdminPages($container);
    }

    public function testList()
    {
        $try = $this->AdminPages->list();
        $this->assertIsArray($try);
    }

    public function testGetColumns()
    {
        $try = $this->AdminPages->getColumns();
        $this->assertIsArray($try);
    }

    public function testFilter()
    {
        $try = $this->AdminPages->filter();
        $this->assertIsArray($try);
    }

    public function testGetFilterFields()
    {
        $try = $this->AdminPages->getFilterFields();
        $this->assertIsArray($try);
    }

    public function testRow()
    {
        $list = new Listing(['item'], 1, 1, []);
        $try = $this->AdminPages->row([], ['list' => $list]);
        $this->assertIsArray($try);
    }
}
