<?php
namespace Tests\note2\models;

use Tests\Test as TestCase;

class PageModelTest extends TestCase
{ 
    private $PageModel;
    static $data;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $app->set('mainPlugin', ['name' => 'page']);
        $container->get('request')->set('urlVars', ['id' => 1]);
        $this->PageModel = $container->get('PageModel');
        $PageEntity = $container->get('PageEntity');

        if (!static::$data)
        {
            $find = $PageEntity->findByPK(2);
            if(!$find)
            {
                $PageEntity->add([
                    'id' => 2,
                    'title' => 'test',
                    'template_id' => 1,
                    'slug' => 'te',
                    'permission' => '',
                    'data' => '',
                    'page_type' => 'html',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 0,
                    'locked_at' => date('Y-m-d H:i:s'),
                    'locked_by' => 0,
                ]);
            }
            static::$data = true;
        }
    } 

    public function testGetTypes()
    {
        $try = $this->PageModel->getTypes();
        $this->assertIsArray($try);
    }

    /**
     * @dataProvider dataSetTemplate
     */
    public function testSetTemplate($path, $result)
    {
        $try = $this->PageModel->setTemplate($path);
        $this->assertEquals($try, $result);
    }

    public function dataSetTemplate()
    {
        return [
            ['blue', false],
            ['blue/one_colum', true],
        ];
    } 

    /**
     * @dataProvider dataRemove
     */
    public function testRemove($id, $result)
    {
        $try = $this->PageModel->remove($id);
        $this->assertEquals($try, $result);
    }

    public function dataRemove()
    {
        return [
            [0, false],
            [2, true],
        ];
    }

    public function testGenerateSlug()
    {
        $try = $this->PageModel->generateSlug('test');
        $this->assertIsString($try);
    }
}
