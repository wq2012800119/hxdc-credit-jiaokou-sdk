<?php
namespace Sdk\User\Staff\Adapter\Staff;

use PHPUnit\Framework\TestCase;

use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\User\Staff\Translator\StaffRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class StaffRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(StaffRestfulAdapterMock::class)
                           ->setMethods([
                               'getTranslator',
                               'post',
                               'patch',
                               'getResource',
                               'isSuccess',
                               'translateToObject'
                            ])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsCommonRestfulAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Adapter\CommonRestfulAdapter',
            $this->stub
        );
    }

    public function testImplementsIStaffAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\User\Staff\Adapter\Staff\IStaffAdapter',
            $this->stub
        );
    }

    public function testGetNullObject()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\INull',
            $this->stub->getNullObjectPublic()
        );

        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\NullStaff',
            $this->stub->getNullObjectPublic()
        );
    }

    //scenario
    /**
     * @dataProvider additionProviderScenario
     */
    public function testScenario($scenario, $expect)
    {
        $this->stub->scenario($scenario);

        $this->assertEquals($expect, $this->stub->getScenario());
    }

    public function additionProviderScenario()
    {
        return array(
            array('STAFF_LIST', StaffRestfulAdapter::SCENARIOS['STAFF_LIST']),
            array('STAFF_FETCH_ONE', StaffRestfulAdapter::SCENARIOS['STAFF_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(StaffRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    public function testInsertTranslatorKeys()
    {
        $this->assertEquals(array(
            'subjectName',
            'cellphone',
            'idCard',
            'password',
            'category',
            'organization',
            'department',
            'roles'
        ), $this->stub->insertTranslatorKeysPublic());
    }

    public function testUpdateTranslatorKeys()
    {
        $this->assertEquals(array(
            'subjectName',
            'cellphone',
            'idCard',
            'organization',
            'department',
            'roles'
        ), $this->stub->updateTranslatorKeysPublic());
    }

    private function login(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $staff = new OrganizationUserStaff($id);
        $data = array('data');

        // 为 StaffRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(StaffRestfulTranslator::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $translator->objectToArray($staff, array('cellphone', 'password'))->shouldBeCalled(1)->willReturn($data);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('post')->with($resource.'/login', $data);
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($staff);
        }

        return $staff;
    }

    public function testLoginTrue()
    {
        $staff = $this->login(true);

        $result = $this->stub->login($staff);

        $this->assertTrue($result);
    }

    public function testLoginFalse()
    {
        $staff = $this->login(false);

        $result = $this->stub->login($staff);

        $this->assertFalse($result);
    }

    private function resetPassword(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $staff = new OrganizationUserStaff($id);
        $data = array('data');

        // 为 StaffRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(StaffRestfulTranslator::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $translator->objectToArray($staff, array('password'))->shouldBeCalled(1)->willReturn($data);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id.'/resetPassword', $data);
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($staff);
        }

        return $staff;
    }

    public function testResetPasswordTrue()
    {
        $staff = $this->resetPassword(true);

        $result = $this->stub->resetPassword($staff);

        $this->assertTrue($result);
    }

    public function testResetPasswordFalse()
    {
        $staff = $this->resetPassword(false);

        $result = $this->stub->resetPassword($staff);

        $this->assertFalse($result);
    }

    private function updatePassword(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $staff = new OrganizationUserStaff($id);
        $data = array('data');

        // 为 StaffRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(StaffRestfulTranslator::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $translator->objectToArray($staff, array('password', 'oldPassword'))->shouldBeCalled(1)->willReturn($data);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id.'/password', $data);
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($staff);
        }

        return $staff;
    }

    public function testUpdatePasswordTrue()
    {
        $staff = $this->updatePassword(true);

        $result = $this->stub->updatePassword($staff);

        $this->assertTrue($result);
    }

    public function testUpdatePasswordFalse()
    {
        $staff = $this->updatePassword(false);

        $result = $this->stub->updatePassword($staff);

        $this->assertFalse($result);
    }
}
