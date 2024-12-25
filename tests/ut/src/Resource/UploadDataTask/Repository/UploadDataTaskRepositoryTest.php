<?php
namespace Sdk\Resource\UploadDataTask\Repository;

use PHPUnit\Framework\TestCase;

class UploadDataTaskRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new UploadDataTaskRepository();
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
            'Sdk\Resource\UploadDataTask\Adapter\UploadDataTask\UploadDataTaskRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Adapter\UploadDataTask\UploadDataTaskMockAdapter',
            $this->stub->getMockAdapter()
        );
    }
}
