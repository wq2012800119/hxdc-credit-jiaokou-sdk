<?php
namespace Sdk\User\Staff\Repository;

use PHPUnit\Framework\TestCase;

use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\User\Staff\Adapter\Staff\IStaffAdapter;

class StaffRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(StaffRepository::class)
                           ->setMethods(['getAdapter'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIStaffAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\User\Staff\Adapter\Staff\IStaffAdapter',
            $this->stub
        );
    }

    public function testExtendsCommonRepository()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Repository\CommonRepository',
            $this->stub
        );
    }

    public function testGetActualAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\User\Staff\Adapter\Staff\StaffRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\User\Staff\Adapter\Staff\StaffMockAdapter',
            $this->stub->getMockAdapter()
        );
    }

    public function testLogin()
    {
        $staff = new OrganizationUserStaff(1);
        // 为 IStaffAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IStaffAdapter::class);
        // 建立预期状况:login() 方法将会被调用一次。
        $adapter->login($staff)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->login($staff);

        $this->assertTrue($result);
    }

    public function testResetPassword()
    {
        $staff = new OrganizationUserStaff(1);
        // 为 IStaffAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IStaffAdapter::class);
        // 建立预期状况:resetPassword() 方法将会被调用一次。
        $adapter->resetPassword($staff)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->resetPassword($staff);

        $this->assertTrue($result);
    }

    public function testUpdatePassword()
    {
        $staff = new OrganizationUserStaff(1);
        // 为 IStaffAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IStaffAdapter::class);
        // 建立预期状况:updatePassword() 方法将会被调用一次。
        $adapter->updatePassword($staff)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->updatePassword($staff);

        $this->assertTrue($result);
    }
}
