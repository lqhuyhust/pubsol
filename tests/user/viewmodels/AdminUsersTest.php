<?php
namespace Tests\user\viewmodels;

use App\plugins\user\viewmodels\AdminUsers;
use SPT\View\Gui\Listing;
use Tests\Test as TestCase;

class AdminUsersTest extends TestCase
{
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');

        $this->AdminUsers = new AdminUsers($container);
    }

    public function testList()
    {
        $try = $this->AdminUsers->list();
        $this->assertIsArray($try);
    }

    public function testGetColumns()
    {
        $try = $this->AdminUsers->getColumns();
        $this->assertIsArray($try);
    }

    public function testFilter()
    {
        $try = $this->AdminUsers->filter();
        $this->assertIsArray($try);
    }

    public function testGetFilterFields()
    {
        $try = $this->AdminUsers->getFilterFields();
        $this->assertIsArray($try);
    }

    public function testRow()
    {
        $list = new Listing(['item'], 1, 1, []);
        $try = $this->AdminUsers->row([], ['list' => $list]);
        $this->assertIsArray($try);
    }
}
