<?php
namespace Sdk\Resource\Directory\Repository;

use PHPUnit\Framework\TestCase;

class SnapshotRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new SnapshotRepository();
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
            'Sdk\Resource\Directory\Adapter\Snapshot\SnapshotRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Adapter\Snapshot\SnapshotMockAdapter',
            $this->stub->getMockAdapter()
        );
    }
}
