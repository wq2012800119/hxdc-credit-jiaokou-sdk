<?php
namespace Sdk\User\Staff\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullStaffTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(NullStaffMock::class)
                           ->setMethods(['resourceNotExist'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsINull()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\INull',
            $this->stub
        );
    }

    public function testExtendsStaff()
    {
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\Staff',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullStaffMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }

    public function testLogin()
    {
         // 为 resourceNotExist() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $this->stub->login();

        $this->assertFalse($result);
    }

    public function testLogout()
    {
         // 为 resourceNotExist() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $this->stub->logout();

        $this->assertFalse($result);
    }

    public function testResetPassword()
    {
         // 为 resourceNotExist() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $this->stub->resetPassword();

        $this->assertFalse($result);
    }

    public function testUpdatePassword()
    {
         // 为 resourceNotExist() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $this->stub->updatePassword();

        $this->assertFalse($result);
    }
}
