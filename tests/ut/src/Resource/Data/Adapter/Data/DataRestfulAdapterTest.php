<?php
namespace Sdk\Resource\Data\Adapter\Data;

use PHPUnit\Framework\TestCase;

class DataRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DataRestfulAdapterMock();
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

    public function testImplementsIDataAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Data\Adapter\Data\IDataAdapter',
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
            'Sdk\Resource\Data\Model\NullData',
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
            array('DATA_LIST', DataRestfulAdapter::SCENARIOS['DATA_LIST']),
            array('DATA_FETCH_ONE', DataRestfulAdapter::SCENARIOS['DATA_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(DataRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    public function testInsertTranslatorKeys()
    {
        $this->assertEquals(array(
            'directory',
            'items',
            'staff'
        ), $this->stub->insertTranslatorKeysPublic());
    }

    public function testUpdateTranslatorKeys()
    {
        $this->assertEquals([], $this->stub->updateTranslatorKeysPublic());
    }
}
