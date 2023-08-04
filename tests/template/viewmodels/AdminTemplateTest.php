<?php
namespace Tests\template\viewmodels;

use App\plugins\template\viewmodels\AdminTemplate;
use SPT\Web\Gui\Listing;
use Tests\Test as TestCase;

class AdminTemplateTest extends TestCase
{
    private $AdminTemplate;
    static $data;
    
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $app->set('themePath', APP_PATH .'themes');
        $TemplateEntity = $container->get('TemplateEntity');
        $request->set('urlVars', ['id' => 2]);

        $this->AdminTemplate = new AdminTemplate($container);
        if (!static::$data)
        {
            $find = $TemplateEntity->findByPK(2);
            if(!$find)
            {
                $TemplateEntity->add([
                    'title' => 'test',
                    'id' => 2,
                    'fnc' => '',
                    'positions' => '',
                    'note' => '',
                    'status' => 1,
                    'path' => 'blue/front',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 0,
                    'locked_at' => date('Y-m-d H:i:s'),
                    'locked_by' => 0,
                ]);
            }
            static::$data = true;
        }
    }

    public function testForm()
    {
        $try = $this->AdminTemplate->form();
        $this->assertIsArray($try);
    }

    public function testGetFormFields()
    {
        $try = $this->AdminTemplate->getFormFields();
        $this->assertIsArray($try);
    }
}
