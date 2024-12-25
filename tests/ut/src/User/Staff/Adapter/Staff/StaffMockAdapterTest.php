<?php
namespace Sdk\User\Staff\Adapter\Staff;

use PHPUnit\Framework\TestCase;

use Sdk\User\Staff\Model\OrganizationUserStaff;

class StaffMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new StaffMockAdapter();
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

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\Staff',
            $this->stub->fetchObject(1)
        );
    }

    public function testLogin()
    {
        $staff = new OrganizationUserStaff(1);

        $this->assertTrue($this->stub->login($staff));
    }

    public function testResetPassword()
    {
        $staff = new OrganizationUserStaff(1);

        $this->assertTrue($this->stub->resetPassword($staff));
    }

    public function testUpdatePassword()
    {
        $staff = new OrganizationUserStaff(1);

        $this->assertTrue($this->stub->updatePassword($staff));
    }
}
