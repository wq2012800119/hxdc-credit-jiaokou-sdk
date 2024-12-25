<?php
namespace Sdk\Resource\Data\Adapter\Data;

use PHPUnit\Framework\TestCase;

class DataMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DataMockAdapter();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIDataAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Data\Adapter\Data\IDataAdapter',
            $this->stub
        );
    }

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Data\Model\Data',
            $this->stub->fetchObject(1)
        );
    }
}
