<?php
namespace Sdk\Resource\Directory\Adapter\Snapshot;

use PHPUnit\Framework\TestCase;

class SnapshotRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new SnapshotRestfulAdapterMock();
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

    public function testImplementsISnapshotAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Adapter\Snapshot\ISnapshotAdapter',
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
            'Sdk\Resource\Directory\Model\NullDirectorySnapshot',
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
            array('SNAPSHOT_LIST', SnapshotRestfulAdapter::SCENARIOS['SNAPSHOT_LIST']),
            array('SNAPSHOT_FETCH_ONE', SnapshotRestfulAdapter::SCENARIOS['SNAPSHOT_FETCH_ONE']),
            array('', [])
        );
    }
}
