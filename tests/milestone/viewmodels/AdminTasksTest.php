<?php
namespace Tests\milestone\viewmodels;

use App\plugins\milestone\viewmodels\AdminTasks;
use Tests\Test as TestCase;
use SPT\View\Gui\Listing;

class AdminTasksTest extends TestCase
{
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $request->set('urlVars', ['request_id' => 1]);
        
        $this->AdminTasks = new AdminTasks($container);
    }

    public function testList()
    {
        $try = $this->AdminTasks->list();
        $this->assertIsArray($try);
    }

    public function testGetColumns()
    {
        $try = $this->AdminTasks->getColumns();
        $this->assertIsArray($try);
    }

    public function testFilter()
    {
        $try = $this->AdminTasks->filter();
        $this->assertIsArray($try);
    }

    public function testGetFilterFields()
    {
        $try = $this->AdminTasks->getFilterFields();
        $this->assertIsArray($try);
    }
}
