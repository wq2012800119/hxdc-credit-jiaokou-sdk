<?php
namespace Sdk\Role\Repository;

use PHPUnit\Framework\TestCase;

class RoleRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new RoleRepository();
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
            'Sdk\Role\Adapter\Role\RoleRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Adapter\Role\RoleMockAdapter',
            $this->stub->getMockAdapter()
        );
    }
}
