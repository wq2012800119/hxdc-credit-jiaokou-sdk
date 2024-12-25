<?php
namespace Sdk\Organization\Department\Repository;

use PHPUnit\Framework\TestCase;

class DepartmentRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DepartmentRepository();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIDepartmentAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Organization\Department\Adapter\Department\IDepartmentAdapter',
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
            'Sdk\Organization\Department\Adapter\Department\DepartmentRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Organization\Department\Adapter\Department\DepartmentMockAdapter',
            $this->stub->getMockAdapter()
        );
    }
}
