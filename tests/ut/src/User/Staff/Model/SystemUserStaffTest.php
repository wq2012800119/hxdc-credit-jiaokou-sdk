<?php
namespace Sdk\User\Staff\Model;

use PHPUnit\Framework\TestCase;

class SystemUserStaffTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new SystemUserStaff();
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
