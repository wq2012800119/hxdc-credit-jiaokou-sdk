<?php
namespace Sdk\Resource\UploadDataTask\Adapter\UploadDataTask;

use PHPUnit\Framework\TestCase;
use Sdk\Resource\UploadDataTask\Model\UploadDataTask;

class UploadDataTaskMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new UploadDataTaskMockAdapter();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIUploadDataTaskAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Adapter\UploadDataTask\IUploadDataTaskAdapter',
            $this->stub
        );
    }

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Model\UploadDataTask',
            $this->stub->fetchObject(1)
        );
    }
}
