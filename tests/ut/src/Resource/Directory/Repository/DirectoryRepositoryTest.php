<?php
namespace Sdk\Resource\Directory\Repository;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\Resource\Directory\Adapter\Directory\IDirectoryAdapter;

class DirectoryRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DirectoryRepository();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIDirectoryAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Adapter\Directory\IDirectoryAdapter',
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
            'Sdk\Resource\Directory\Adapter\Directory\DirectoryRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Adapter\Directory\DirectoryMockAdapter',
            $this->stub->getMockAdapter()
        );
    }

    public function testRollback()
    {
        $stub = $this->getMockBuilder(DirectoryRepository::class)->setMethods(['getAdapter'])->getMock();

        $directory = new Directory(1);
        // 为 IDirectoryAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IDirectoryAdapter::class);
        // 建立预期状况:rollback() 方法将会被调用一次。
        $adapter->rollback($directory)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $stub->rollback($directory);
        $this->assertTrue($result);
    }

    public function testExport()
    {
        $stub = $this->getMockBuilder(DirectoryRepository::class)->setMethods(['getAdapter'])->getMock();

        $directory = new Directory(1);
        // 为 IDirectoryAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IDirectoryAdapter::class);
        // 建立预期状况:export() 方法将会被调用一次。
        $adapter->export($directory)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $stub->export($directory);
        $this->assertTrue($result);
    }
}
