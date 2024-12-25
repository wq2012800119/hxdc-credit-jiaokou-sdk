<?php
namespace Sdk\Role\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullRoleTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullRole::getInstance();
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

    public function testExtendsRole()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Model\Role',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullRoleMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }
}
