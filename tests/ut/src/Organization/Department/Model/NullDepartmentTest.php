<?php
namespace Sdk\Organization\Department\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullDepartmentTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullDepartment::getInstance();
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

    public function testExtendsDepartment()
    {
        $this->assertInstanceOf(
            'Sdk\Organization\Department\Model\Department',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullDepartmentMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }
}
