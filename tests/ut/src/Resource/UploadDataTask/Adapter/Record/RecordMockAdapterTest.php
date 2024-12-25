<?php
namespace Sdk\Resource\UploadDataTask\Adapter\Record;

use PHPUnit\Framework\TestCase;

class RecordMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new RecordMockAdapter();
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

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Model\UploadDataTaskRecord',
            $this->stub->fetchObject(1)
        );
    }
}
