<?php
namespace Sdk\Resource\Directory\Model;

use PHPUnit\Framework\TestCase;

class NullDirectorySnapshotTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullDirectorySnapshot::getInstance();
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

    public function testExtendsDirectorySnapshot()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\DirectorySnapshot',
            $this->stub
        );
    }
}
