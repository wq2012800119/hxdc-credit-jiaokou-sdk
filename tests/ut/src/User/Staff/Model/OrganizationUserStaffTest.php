<?php
namespace Sdk\User\Staff\Model;

use PHPUnit\Framework\TestCase;

class OrganizationUserStaffTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new OrganizationUserStaff();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsStaff()
    {
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\Staff',
            $this->stub
        );
    }
}
