<?php
namespace Tests\page_html\models;

use Tests\Test as TestCase;

class PageHtmlModelTest extends TestCase
{ 
    private $PageHtmlModel;
    static $data;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $app->set('mainPlugin', ['name' => 'page']);
        $container->get('request')->set('urlVars', ['id' => 1]);
        $this->PageHtmlModel = $container->get('PageHtmlModel');
        $PageEntity = $container->get('PageEntity');

        if (!static::$data)
        {
            $find = $PageEntity->findOne(['slug' => 'pagehtml']);
            if ($find)
            {
                $PageEntity->remove($find['id']);
            }

            $find = $PageEntity->findByPK(4);
            if(!$find)
            {
                $PageEntity->add([
                    'id' => 4,
                    'title' => 'test',
                    'template_id' => 1,
                    'slug' => 'test4',
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

    /**
     * @dataProvider dataValidate
     */
    public function testValidate($data, $result)
    {
        $try = $this->PageHtmlModel->validate($data);
        $try = $try ? true : false;
        $this->assertEquals($try, $result);
    }

    public function dataValidate()
    {
        return [
            [[], false],
            [
                ['title' => ''], false
            ],
            [
                ['title' => 'test contact',
                'slug' => 'tét a'], false
            ],
            [
                [
                    'title' => 'test contact',
                    'slug' => 'testslug',
                ], true
            ],
        ];
    } 

    /**
     * @dataProvider dataAdd
     */
    public function testAdd($data, $result)
    {
        $try = $this->PageHtmlModel->add($data);
        $this->assertEquals($try, $result);
    }

    public function dataAdd()
    {
        return [
            [[], false],
            [
                ['title' => ''], false
            ],
            [
                [
                    'title' => 'test contact page',
                    'template_id' => 1,
                    'slug' => 'pagehtml',
                    'data' => '',
                ], true
            ],
        ];
    } 

    /**
     * @dataProvider dataUpdate
     */
    public function testUpdate($data, $result)
    {
        $try = $this->PageHtmlModel->update($data);
        $this->assertEquals($try, $result);
    }

    public function dataUpdate()
    {
        return [
            [[], false],
            [
                ['title' => ''], false
            ],
            [
                [
                    'title' => 'test contact page',
                    'template_id' => 1,
                    'slug' => 'pagehtml3',
                    'data' => '',
                    'id' => 4,
                ], true
            ],
        ];
    }
}
