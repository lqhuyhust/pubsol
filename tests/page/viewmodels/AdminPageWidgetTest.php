<?php
namespace Tests\page\viewmodels;

use App\plugins\page\viewmodels\AdminPages;
use App\plugins\page\viewmodels\AdminPageWidget;
use SPT\Web\Gui\Listing;
use Tests\Test as TestCase;

class AdminPageWidgetTest extends TestCase
{
    private $AdminPageWidget;
    
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $request->set('urlVars', ['request_id' => 1]);

        $this->AdminPageWidget = new AdminPageWidget($container);
    }

    public function testPopup_new()
    {
        $try = $this->AdminPageWidget->popup_new();
        $this->assertIsArray($try);
    }
}
