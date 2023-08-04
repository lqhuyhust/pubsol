<?php
namespace Tests\page_contact\viewmodels;

use App\plugins\page_contact\viewmodels\ContactPage;
use SPT\Web\Gui\Listing;
use Tests\Test as TestCase;

class ContactPageTest extends TestCase
{
    private $ContactPage;
    
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $request->set('urlVars', ['request_id' => 1]);

        $this->ContactPage = new ContactPage($container);
    }

    public function testContact()
    {
        $try = $this->ContactPage->contact();
        $this->assertIsArray($try);
    }
}
