<?php
namespace Sdk\Resource\Directory\Adapter\Snapshot;

use PHPUnit\Framework\TestCase;

class SnapshotMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new SnapshotMockAdapter();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsISnapshotAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Adapter\Snapshot\ISnapshotAdapter',
            $this->stub
        );
    }

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\DirectorySnapshot',
            $this->stub->fetchObject(1)
        );
    }
}
