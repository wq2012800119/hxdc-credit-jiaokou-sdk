<?php
namespace Sdk\Resource\Directory\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullDirectoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullDirectory::getInstance();
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

    public function testExtendsDirectory()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\Directory',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullDirectoryMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }
    
    public function testRollback()
    {
        $stub = $this->getMockBuilder(NullDirectoryMock::class)->setMethods(['resourceNotExist'])->getMock();

        $stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $stub->rollback();
        $this->assertFalse($result);
    }
    
    public function testExport()
    {
        $stub = $this->getMockBuilder(NullDirectoryMock::class)->setMethods(['resourceNotExist'])->getMock();

        $stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $stub->export();
        $this->assertFalse($result);
    }
}
