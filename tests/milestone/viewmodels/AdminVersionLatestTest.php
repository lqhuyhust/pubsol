<?php
namespace Tests\milestone\viewmodels;

use App\plugins\milestone\viewmodels\AdminVersionLatest;
use Tests\Test as TestCase;
use SPT\View\Gui\Listing;

class AdminVersionLatestTest extends TestCase
{

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $request->set('urlVars', ['request_id' => 1]);

        $this->AdminVersionLatest = new AdminVersionLatest($container);
    }

    public function testList()
    {
        $try = $this->AdminVersionLatest->list();
        $this->assertIsArray($try);
    }

}
