<?php
namespace Tests\tag\viewmodels;

use DTM\version\viewmodels\AdminVersion;
use SPT\View\Gui\Listing;
use Tests\Test as TestCase;

class AdminVersionTest extends TestCase
{   
    private $AdminVersion;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $request->set('urlVars', ['version_id' => 1]);

        $this->AdminVersion = new AdminVersion($container);
    }

    public function testForm()
    {
        $try = $this->AdminVersion->form();
        $this->assertIsArray($try);
    }

    public function testGetFormFields()
    {
        $try = $this->AdminVersion->getFormFields();
        $this->assertIsArray($try);
    }
}
