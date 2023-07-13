<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace Tests\note2_file\models;

use Tests\note2_file\libraries\File;
use Tests\Test as TestCase;

class NoteFileModelTest extends TestCase
{ 
    private $NoteFileModel;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $file = new File();
        $container->set('file', $file);
        $container->get('request')->set('urlVars', ['id' => 1]);
        $this->NoteFileModel = $container->get('NoteFileModel');
    }
    
    /**
     * @dataProvider dataValidate
     */
    public function testValidate($data, $is_update, $result)
    {
        $try = $this->NoteFileModel->validate($data, $is_update);
        $this->assertEquals($try, $result);
    }

    public function dataValidate()
    {
        return [
            [[], 0, false],
            [[
                'title' => ''
            ], 0, false],
            [[
                'title' => 'Test'
            ], 0, false],
            [[
                'title' => 'Test',
                'file' => [],
            ], 0, false],
            [[
                'title' => 'Test',
                'file' => [
                    'name' => '',
                ],
            ], 0, false],
            [[
                'title' => 'Test',
                'file' => [
                    'name' => 'test.txt',
                ],
            ], 0, true],
            [[
                'title' => '',
            ], 1, false],
            [[
                'title' => 'Test',
            ], 1, true],
        ];
    }

    public function testCreateFolderSave()
    {
        $try = $this->NoteFileModel->createFolderSave();
        $this->assertNotEmpty($try);
    }

    /**
     * @dataProvider dataUpload
     */
    public function testUpload($file, $result)
    {
        $try = $this->NoteFileModel->upload($file);
        $try = $try ? true : false;
        $this->assertEquals($try, $result);
    }

    public function dataUpload()
    {
        return [
            [[], false],
            [[
                'name' => ''
            ], false],
            [[
                'name' => 'test.txt',
                'tmp_name' => ''
            ], false],
            [[
                'name' => 'test.txt',
                'tmp_name' => 'test.txt'
            ], true],
        ];
    }

    public function testGetCurrentId()
    {
        $try = $this->NoteFileModel->getCurrentId();
        $this->assertEquals($try, 1);
    }

    /**
     * @dataProvider dataAdd
     */
    public function testAdd($data, $result)
    {
        $try = $this->NoteFileModel->add($data);
        $try = $try ? true : false;
        $this->assertEquals($try, $result);
    }

    public function dataAdd()
    {
        return [
            [[], false],
            [[
                'title' => '',
            ], false],
            [[
                'title' => 'test',
                'file' => []
            ], false],
            [[
                'title' => 'test',
                'file' => [
                    'name' => '',
                ],
            ], false],
            [[
                'title' => 'test',
                'file' => [
                    'name' => 'test.txt',
                    'tmp_name' => '',
                ]
            ], false],
            [[
                'title' => 'test',
                'file' => [
                    'name' => 'test.txt',
                    'tmp_name' => 'test.txt',
                ],
                'notice' => 'test',
            ], true],
        ];
    }
    
    /**
     * @dataProvider dataUpdate
     * @depends testAdd
     */
    public function testUpdate($data, $result)
    {
        $try = $this->NoteFileModel->update($data);
        $try = $try ? true : false;
        $this->assertEquals($try, $result);
    }

    public function dataUpdate()
    {
        return [
            [[], false],
            [[
                'title' => '',
            ], false],
            [[
                'title' => 'test',
            ], false],
            [[
                'title' => 'test',
                'id' => 1,
            ], true],
        ];
    }

    /**
     * @dataProvider dataRemove
     * @depends testAdd
     * @depends testUpdate
     */
    public function testRemove($id, $result)
    {
        $try = $this->NoteFileModel->remove($id);
        
        $this->assertEquals($try, $result);
    } 

    public function dataRemove()
    {
        return [
            [0, false],
            [2, true],
            [3, true],
        ];
    }

     /**
     * @dataProvider dataGetDetail
     * @depends testAdd
     * @depends testUpdate
     */
    public function testGetDetail($id, $result)
    {
        $try = $this->NoteFileModel->getDetail($id);
        $try = $try ? true : false;
        $this->assertEquals($try, $result);
    } 

    public function dataGetDetail()
    {
        return [
            [0, false],
            [1, true],
        ];
    }
}
