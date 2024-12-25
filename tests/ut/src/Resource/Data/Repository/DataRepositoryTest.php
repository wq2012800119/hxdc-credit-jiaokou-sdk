<?php
namespace Sdk\Resource\Data\Repository;

use PHPUnit\Framework\TestCase;

class DataRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DataRepository();
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
            'Sdk\Resource\Data\Adapter\Data\DataRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Data\Adapter\Data\DataMockAdapter',
            $this->stub->getMockAdapter()
        );
    }
}
