<?php
namespace Sdk\User\Member\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class NullMemberTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(NullMemberMock::class)
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

    public function testExtendsMember()
    {
        $this->assertInstanceOf(
            'Sdk\User\Member\Model\Member',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullMemberMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }

    public function initOperation($method)
    {
         $this->stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

         $result = $this->stub->$method();
 
         $this->assertFalse($result);
    }

    public function testLogin()
    {
        $this->initOperation('login');
    }

    public function testLogout()
    {
        $this->initOperation('logout');
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

    public function testValidatePassword()
    {
        $this->initOperation('validatePassword');
    }
}
