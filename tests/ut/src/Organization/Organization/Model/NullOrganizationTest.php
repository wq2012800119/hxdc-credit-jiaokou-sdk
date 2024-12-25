<?php
namespace Sdk\Organization\Organization\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullOrganizationTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullOrganization::getInstance();
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

    public function testExtendsOrganization()
    {
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\Organization',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullOrganizationMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }
}
