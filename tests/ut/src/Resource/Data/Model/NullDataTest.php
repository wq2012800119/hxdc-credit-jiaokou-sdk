<?php
namespace Sdk\Resource\Data\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullDataTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullData::getInstance();
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

    public function testExtendsData()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Data\Model\Data',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullDataMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }
}
