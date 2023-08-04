<?php
namespace Tests\widget\viewmodels;

use App\plugins\widget\viewmodels\AdminWidget;
use SPT\Web\Gui\Listing;
use Tests\Test as TestCase;

class AdminWidgetTest extends TestCase
{
    private $AdminWidget;
    
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $app->set('themePath', APP_PATH .'themes');
        $request->set('urlVars', ['id' => 2]);
        $this->AdminWidget = new AdminWidget($container);
    }

    public function testSelect_widget()
    {
        $try = $this->AdminWidget->select_widget();
        $this->assertIsArray($try);
    }
    
    public function testJavascript()
    {
        $try = $this->AdminWidget->javascript();
        $this->assertIsArray($try);
    }
}
