<?php
namespace Sdk\Resource\Directory\Adapter\Directory;

use PHPUnit\Framework\TestCase;
use Sdk\Resource\Directory\Model\Directory;

class DirectoryMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DirectoryMockAdapter();
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

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\Directory',
            $this->stub->fetchObject(1)
        );
    }

    public function testRollback()
    {
        $directory = new Directory(1);

        $this->assertTrue($this->stub->rollback($directory));
    }

    public function testExport()
    {
        $directory = new Directory(1);

        $this->assertTrue($this->stub->export($directory));
    }
}
