<?php
namespace Tests\user\viewmodels;

use App\plugins\user\viewmodels\AdminUser;
use Tests\Test as TestCase;

class AdminUserTest extends TestCase
{
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');

        $this->AdminUser = new AdminUser($container);
    }

    public function testLogin()
    {
        $layout = [];
        $try = $this->AdminUser->login([], $layout);
        $this->assertIsArray($try);
    }

    public function testForm()
    {
        $try = $this->AdminUser->form();
        $this->assertIsArray($try);
    }

    public function testGetFormFields()
    {
        $try = $this->AdminUser->getFormFields(1);
        $this->assertIsArray($try);
    }

    public function testProfile()
    {
        $try = $this->AdminUser->profile();
        $this->assertIsArray($try);
    }

    public function testGetFormFieldsProfile()
    {
        $try = $this->AdminUser->getFormFieldsProfile();
        $this->assertIsArray($try);
    }
}
