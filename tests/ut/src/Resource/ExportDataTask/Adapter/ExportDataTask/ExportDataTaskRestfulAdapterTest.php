<?php
namespace Sdk\Resource\ExportDataTask\Adapter\ExportDataTask;

use PHPUnit\Framework\TestCase;
use Sdk\Resource\ExportDataTask\Utils\MockObjectGenerate;

class ExportDataTaskRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ExportDataTaskRestfulAdapterMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsCommonRestfulAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Adapter\CommonRestfulAdapter',
            $this->stub
        );
    }

    public function testImplementsIExportDataTaskAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\ExportDataTask\Adapter\ExportDataTask\IExportDataTaskAdapter',
            $this->stub
        );
    }

    public function testGetNullObject()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\INull',
            $this->stub->getNullObjectPublic()
        );

        $this->assertInstanceOf(
            'Sdk\Resource\ExportDataTask\Model\NullExportDataTask',
            $this->stub->getNullObjectPublic()
        );
    }

    //scenario
    /**
     * @dataProvider additionProviderScenario
     */
    public function testScenario($scenario, $expect)
    {
        $this->stub->scenario($scenario);

        $this->assertEquals($expect, $this->stub->getScenario());
    }

    public function additionProviderScenario()
    {
        return array(
            array('EXPORT_DATA_TASK_LIST', ExportDataTaskRestfulAdapter::SCENARIOS['EXPORT_DATA_TASK_LIST']),
            array('EXPORT_DATA_TASK_FETCH_ONE', ExportDataTaskRestfulAdapter::SCENARIOS['EXPORT_DATA_TASK_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(ExportDataTaskRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    public function testInsertTranslatorKeys()
    {
        $this->assertEquals(array(
            'filter',
            'sort',
            'offset',
            'size',
            'directorySnapshot',
            'staff'
        ), $this->stub->insertTranslatorKeysPublic());
    }

    public function testUpdateTranslatorKeys()
    {
        $this->assertEquals([], $this->stub->updateTranslatorKeysPublic());
    }
}
