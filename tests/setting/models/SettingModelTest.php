<?php
namespace Tests\setting\models;

use Tests\Test as TestCase;

class SettingModelTest extends TestCase 
{ 
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $this->SettingModel = $container->get('SettingModel');
    }

    public function testGetSetting()
    {
        $try = $this->SettingModel->getSetting();
        $this->assertIsArray($try);
    }
}
