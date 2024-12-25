<?php
namespace Sdk\Role\Adapter\Role;

use PHPUnit\Framework\TestCase;

class RoleMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new RoleMockAdapter();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIRoleAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Adapter\Role\IRoleAdapter',
            $this->stub
        );
    }

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Model\Role',
            $this->stub->fetchObject(1)
        );
    }
}
