<?php
namespace Tests\tag\viewmodels;

use DTM\version\viewmodels\AdminFeedback;
use SPT\View\Gui\Listing;
use Tests\Test as TestCase;

class AdminFeedbackTest extends TestCase
{
    private $AdminFeedback;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $request->set('urlVars', ['version_id' => 1]);

        $this->AdminFeedback = new AdminFeedback($container);
    }
    
    public function testList()
    {
        $try = $this->AdminFeedback->list();
        $this->assertIsArray($try);
    }

    public function testGetColumns()
    {
        $try = $this->AdminFeedback->getColumns();
        $this->assertIsArray($try);
    }

    public function testFilter()
    {
        $try = $this->AdminFeedback->filter();
        $this->assertIsArray($try);
    }

    public function testGetFilterFields()
    {
        $try = $this->AdminFeedback->getFilterFields();
        $this->assertIsArray($try);
    }

    public function testRow()
    {
        $list = new Listing(['item'], 1, 1, []);
        $try = $this->AdminFeedback->row([], ['list' => $list]);
        $this->assertIsArray($try);
    }
}
