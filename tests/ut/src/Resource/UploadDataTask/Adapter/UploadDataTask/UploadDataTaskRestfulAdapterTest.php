<?php
namespace Sdk\Resource\UploadDataTask\Adapter\UploadDataTask;

use PHPUnit\Framework\TestCase;
use Sdk\Resource\UploadDataTask\Utils\MockObjectGenerate;

class UploadDataTaskRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new UploadDataTaskRestfulAdapterMock();
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

    public function testImplementsIUploadDataTaskAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Adapter\UploadDataTask\IUploadDataTaskAdapter',
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
            'Sdk\Resource\UploadDataTask\Model\NullUploadDataTask',
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
            array('UPLOAD_DATA_TASK_LIST', UploadDataTaskRestfulAdapter::SCENARIOS['UPLOAD_DATA_TASK_LIST']),
            array('UPLOAD_DATA_TASK_FETCH_ONE', UploadDataTaskRestfulAdapter::SCENARIOS['UPLOAD_DATA_TASK_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(UploadDataTaskRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    public function testInsertTranslatorKeys()
    {
        $this->assertEquals(array(
            'name',
            'directory',
            'staff'
        ), $this->stub->insertTranslatorKeysPublic());
    }

    public function testUpdateTranslatorKeys()
    {
        $this->assertEquals([], $this->stub->updateTranslatorKeysPublic());
    }
}
