<?php
namespace Sdk\Resource\ExportDataTask\Adapter\ExportDataTask;

use PHPUnit\Framework\TestCase;
use Sdk\Resource\ExportDataTask\Model\ExportDataTask;

class ExportDataTaskMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ExportDataTaskMockAdapter();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIExportDataTaskAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\ExportDataTask\Adapter\ExportDataTask\IExportDataTaskAdapter',
            $this->stub
        );
    }

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\ExportDataTask\Model\ExportDataTask',
            $this->stub->fetchObject(1)
        );
    }
}
