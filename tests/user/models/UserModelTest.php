<?php
namespace Tests\user\models;

use App\plugins\user\entities\GroupEntity;
use App\plugins\user\entities\UserEntity;
use App\plugins\user\entities\UserGroupEntity;
use App\plugins\user\models\UserGroupModel;
use App\plugins\user\models\UserModel;
use Tests\Test as TestCase;

class UserModelTest extends TestCase
{ 
    private $UserModel;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $this->UserModel = $container->get('UserModel');
    }

    /**
     * @dataProvider dataValidate
     */
    public function testValidate($data,$id, $result)
    {
        $try = $this->UserModel->validate($data, $id);
        $this->assertEquals($try, $result);
    }

    public function dataValidate()
    {
        return [
            [[], 0 , false],
            [
                [
                    'username' => '',
                    'password' => '',
                    'email' => '',
                ], 0, false],
            [
                [
                    'username' => 'Test2',
                    'password' => '12345667',
                    'email' => 'admin1@gmail.com',
                ], 1, true
            ],
        ];
    }

    /**
     * @dataProvider dataGetAccessByGroup
     */
    public function testGetAccessByGroup($data, $result)
    {
        $try = $this->UserModel->getAccessByGroup($data);
        $try = is_array($try) ? true : false;
        $this->assertEquals($try, $result);
    }

    public function dataGetAccessByGroup()
    {
        return [
            ['', false],
            [[1], true],
        ];
    }

    /**
     * @dataProvider dataAdd
     */
    public function testAdd($data, $result)
    {
        $try = $this->UserModel->add($data);
        $try = $try ? true : false;
        $this->assertEquals($try, $result);

    }

    public function dataAdd()
    {
        return [
            [[], false],
            [
                [
                    'username' => '',
                    'password' => '',
                    'email' => '',
                ], false],
            [
                [
                    'name' => 'Test',
                    'username' => 'admin',
                    'password' => '123123',
                    'status' => 1,
                    'email' => 'admin@gmail.com',
                ], true
            ],
            [
                [
                    'name' => 'Test 2',
                    'username' => 'admin2',
                    'password' => '123123',
                    'status' => 1,
                    'email' => 'admin@gmail.com',
                ], true
            ],
        ];
    }

     /**
     * @dataProvider dataUpdate
     * @depends testAdd
     */
    public function testUpdate($data, $result)
    {
        $try = $this->UserModel->update($data);
        $this->assertEquals($try, $result);
    }

    public function dataUpdate()
    {
        return [
            [[], false],
            [
                [
                    'username' => '',
                    'password' => '',
                    'email' => '',
                    'id' => '',
                ], false],
            [
                [
                    'name' => 'Test',
                    'username' => 'Test',
                    'id' => 2,
                    'status' => 1,
                    'email' => 'admin@gmail.com',
                ], true
            ],
        ];
    }

    /**
     * @dataProvider dataRemove
     */
    public function testRemove($data, $result)
    {
        $try = $this->UserModel->remove($data);
        $this->assertEquals($try, $result);
    }

    public function dataRemove()
    {
        return [
            [0, false],
            [3, true],
        ];
    }

    /**
     * @dataProvider dataLogin
     */
    public function testLogin($username, $password, $result)
    {
        $try = $this->UserModel->login($username, $password);
        $this->assertEquals($try, $result);
    }
    
    public function dataLogin()
    {
        return [
            ['', '123123', false],
            ['admin', '', false],
            ['admin', '123123', true],
        ];
    }
}
