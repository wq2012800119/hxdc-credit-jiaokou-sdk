<?php
namespace Sdk\Resource\UploadDataTask\Repository;

use PHPUnit\Framework\TestCase;

class RecordRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new RecordRepository();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIRecordAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Adapter\Record\IRecordAdapter',
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
            'Sdk\Resource\UploadDataTask\Adapter\Record\RecordRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Adapter\Record\RecordMockAdapter',
            $this->stub->getMockAdapter()
        );
    }
}
