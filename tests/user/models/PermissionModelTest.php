<?php
namespace Tests\user\models;

use Tests\Test as TestCase;

class PermissionModelTest extends TestCase
{
    private $PermissionModel;
    private $request;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $_SERVER['REQUEST_METHOD'] = 'get';
        $this->PermissionModel = $container->get('PermissionModel');
        $user = $container->get('user');
        $user->set('id', 1);
        $this->request = $container->get('request');
    }

    public function testGetAccess()
    {
        $try = $this->PermissionModel->getAccess();
        $this->assertIsArray($try);
    }

    /**
     * @dataProvider dataCheckPermission
     */
    public function testCheckPermission($data, $result)
    {
        $try = $this->PermissionModel->checkPermission($data);
        $this->assertEquals($try, $result);
    }

    public function dataCheckPermission()
    {
        return [
            [[], true],
            [['user_manager'], true],
            [['user_create'], false],
        ];
    }

    public function testGetAccessByUser()
    {
        $try = $this->PermissionModel->getAccessByUser();
        $this->assertIsArray($try);
    }

    /**
     * @dataProvider dataCheckPermissionObject
     */
    public function testCheckPermissionObject($object, $param, $column, $id, $result)
    {
        $this->request->set('urlVars', [$param => $id]);
        $try = $this->PermissionModel->checkPermissionObject($object, $param, $column);
        $this->assertEquals($try, $result);
    }

    public function dataCheckPermissionObject()
    {
        return [
            ['RequestEntity', 'id', 'assignment', 0, false],
            ['RequestEntity', 'id', 'assignment', 3,true],
        ];
    }
}