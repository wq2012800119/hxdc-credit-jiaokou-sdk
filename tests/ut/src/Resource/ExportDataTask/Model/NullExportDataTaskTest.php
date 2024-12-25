<?php
namespace Sdk\Resource\ExportDataTask\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullExportDataTaskTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullExportDataTask::getInstance();
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

    public function testExtendsExportDataTask()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\ExportDataTask\Model\ExportDataTask',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullExportDataTaskMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }
}
