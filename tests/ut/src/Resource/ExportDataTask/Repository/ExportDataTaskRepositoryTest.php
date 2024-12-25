<?php
namespace Sdk\Resource\ExportDataTask\Repository;

use PHPUnit\Framework\TestCase;

class ExportDataTaskRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ExportDataTaskRepository();
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
            'Sdk\Resource\ExportDataTask\Adapter\ExportDataTask\ExportDataTaskRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\ExportDataTask\Adapter\ExportDataTask\ExportDataTaskMockAdapter',
            $this->stub->getMockAdapter()
        );
    }
}
