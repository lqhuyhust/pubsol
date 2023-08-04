<?php
namespace Tests\page_html\viewmodels;

use App\plugins\page_html\viewmodels\HtmlPage;
use SPT\Web\Gui\Listing;
use Tests\Test as TestCase;

class HtmlPageTest extends TestCase
{
    private $HtmlPage;
    
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $request->set('urlVars', ['request_id' => 1]);

        $this->HtmlPage = new HtmlPage($container);
    }

    public function testHtml()
    {
        $try = $this->HtmlPage->html();
        $this->assertIsArray($try);
    }
}
