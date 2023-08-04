<?php
namespace Tests\page_contact\viewmodels;

use App\plugins\page_contact\viewmodels\AdminPage;
use SPT\Web\Gui\Listing;
use Tests\Test as TestCase;

class AdminPageTest extends TestCase
{
    private $AdminPage;
    
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $request->set('urlVars', ['request_id' => 1]);

        $this->AdminPage = new AdminPage($container);
    }

    public function testForm()
    {
        $try = $this->AdminPage->form();
        $this->assertIsArray($try);
    }

    public function testGetFormFields()
    {
        $try = $this->AdminPage->getFormFields();
        $this->assertIsArray($try);
    }
}
