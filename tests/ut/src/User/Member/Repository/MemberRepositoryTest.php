<?php
namespace Sdk\User\Member\Repository;

use PHPUnit\Framework\TestCase;

use Sdk\User\Member\Model\Member;
use Sdk\User\Member\Adapter\Member\IMemberAdapter;

class MemberRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(MemberRepository::class)
                           ->setMethods(['getAdapter'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIMemberAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\User\Member\Adapter\Member\IMemberAdapter',
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
            'Sdk\User\Member\Adapter\Member\MemberRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\User\Member\Adapter\Member\MemberMockAdapter',
            $this->stub->getMockAdapter()
        );
    }

    protected function initOperation($method)
    {
        $member = new Member(1);
        // 为 IMemberAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IMemberAdapter::class);
        // 建立预期状况:$method() 方法将会被调用一次。
        $adapter->$method($member)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->$method($member);

        $this->assertTrue($result);
    }

    public function testLogin()
    {
        $this->initOperation('login');
    }

    public function testResetPassword()
    {
        $this->initOperation('resetPassword');
    }

    public function testUpdatePassword()
    {
        $this->initOperation('updatePassword');
    }

    public function testValidateAnswer()
    {
        $this->initOperation('validateAnswer');
    }

    public function testUpdateSecurityQuestion()
    {
        $this->initOperation('updateSecurityQuestion');
    }
}
