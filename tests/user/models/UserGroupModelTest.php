<?php
namespace Tests\user\models;

use Tests\Test as TestCase;

class UserGroupModelTest extends TestCase
{ 
    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $this->UserGroupModel = $container->get('UserGroupModel');
    }

    /**
     * @dataProvider dataRemoveByGroup
     */
    public function testRemoveByGroup($id, $result)
    {
        $try = $this->UserGroupModel->removeByGroup($id);
        $this->assertEquals($try, $result);
    }

    public function dataRemoveByGroup()
    {
        return [
            [2, true],
            [3, true],
        ];
    }

    /**
     * @dataProvider dataRemoveByUser
     */
    public function testRemoveByUser($id, $result)
    {
        $try = $this->UserGroupModel->removeByUser($id);
        $this->assertEquals($try, $result);
    }

    public function dataRemoveByUser()
    {
        return [
            [2, true],
            [3, true],
        ];
    }

    /**
     * @dataProvider dataUpdateUserMap
     */
    public function testUpdateUserMap($id, $groups, $result)
    {
        $try = $this->UserGroupModel->updateUserMap($id, $groups);
        $this->assertEquals($try, $result);
    }

    public function dataUpdateUserMap()
    {
        return [
            ['', [], false],
            [2, [1,2], true],
        ];
    }

    /**
     * @dataProvider dataAddUserMap
     */
    public function testAddUserMap($id, $groups, $result)
    {
        $try = $this->UserGroupModel->addUserMap($id, $groups);
        $this->assertEquals($try, $result);
    }

    public function dataAddUserMap()
    {
        return [
            ['', [], false],
            [2, [1,2], true],
        ];
    }

    /**
     * @dataProvider dataValidate
     */
    public function testValidate($data, $result)
    {
        $try = $this->UserGroupModel->validate($data);
        $this->assertEquals($try, $result);
    }

    public function dataValidate()
    {
        return [
            [[], false],
            [['name' => ''], false],
            [['name' => 'Test'], true],
        ];
    }

    /**
     * @dataProvider dataAdd
     */
    public function testAdd($data, $result)
    {
        $try = $this->UserGroupModel->add($data);
        $this->assertEquals($try, $result);
    }

    public function dataAdd()
    {
        return [
            [[], false],
            [['name' => ''], false],
            [[
                'name' => 'Test',
                'description' => '',
                'access' => '',
                'status' => 0,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'modified_by' => 1,
                'modified_at' => date('Y-m-d H:i:s')
            ], true],
        ];
    }

    /**
     * @dataProvider dataUpdate
     */
    public function testUpdate($data, $result)
    {
        $try = $this->UserGroupModel->update($data);
        $this->assertEquals($try, $result);
    }

    public function dataUpdate()
    {
        return [
            [[], false],
            [['name' => ''], false],
            [[
                'name' => 'Test',
                'description' => '',
                'id' => 2,
                'access' => '',
                'status' => 0,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'modified_by' => 1,
                'modified_at' => date('Y-m-d H:i:s')
            ], true],
        ];
    }

    /**
     * @dataProvider dataRemove()
     */
    public function testRemove($id, $result)
    {
        $try = $this->UserGroupModel->remove($id);
        $this->assertEquals($try, $result);
    }

    /**
     * @dataProvider dataRemove()
     */
    public function dataRemove()
    {
        return [
            [0, false],
            [3, true],
        ];
    }
}
