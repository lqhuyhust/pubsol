<?php
namespace Tests\user\viewmodels;

use App\plugins\user\viewmodels\AdminGroup;
use Tests\Test as TestCase;

class AdminGroupTest extends TestCase
{
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $request->set('urlVars', ['id' => 1]);

        $this->AdminGroup = new AdminGroup($container);
    }

    public function testForm()
    {
        $try = $this->AdminGroup->form();
        $this->assertIsArray($try);
    }

    public function testGetFormFields()
    {
        $try = $this->AdminGroup->getFormFields(0);
        $this->assertIsArray($try);
    }

}
