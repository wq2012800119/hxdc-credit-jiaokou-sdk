<?php
namespace Sdk\Resource\UploadDataTask\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullUploadDataTaskTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullUploadDataTask::getInstance();
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

    public function testExtendsUploadDataTask()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Model\UploadDataTask',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullUploadDataTaskMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }
}
