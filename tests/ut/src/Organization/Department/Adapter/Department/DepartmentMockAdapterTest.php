<?php
namespace Sdk\Organization\Department\Adapter\Department;

use PHPUnit\Framework\TestCase;

class DepartmentMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DepartmentMockAdapter();
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

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Organization\Department\Model\Department',
            $this->stub->fetchObject(1)
        );
    }
}
