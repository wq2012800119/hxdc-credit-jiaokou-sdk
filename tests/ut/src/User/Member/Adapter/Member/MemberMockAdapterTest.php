<?php
namespace Sdk\User\Member\Adapter\Member;

use PHPUnit\Framework\TestCase;

use Sdk\User\Member\Model\Member;

class MemberMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new MemberMockAdapter();
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

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\User\Member\Model\Member',
            $this->stub->fetchObject(1)
        );
    }

    public function testLogin()
    {
        $member = new Member(1);

        $this->assertTrue($this->stub->login($member));
    }

    public function testValidateAnswer()
    {
        $member = new Member(1);

        $this->assertTrue($this->stub->validateAnswer($member));
    }

    public function testUpdateSecurityQuestion()
    {
        $member = new Member(1);

        $this->assertTrue($this->stub->updateSecurityQuestion($member));
    }

    public function testResetPassword()
    {
        $member = new Member(1);

        $this->assertTrue($this->stub->resetPassword($member));
    }

    public function testUpdatePassword()
    {
        $member = new Member(1);

        $this->assertTrue($this->stub->updatePassword($member));
    }
}
