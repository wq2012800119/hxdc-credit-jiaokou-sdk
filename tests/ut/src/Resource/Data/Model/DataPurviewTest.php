<?php
namespace Sdk\Resource\Data\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Role\Purview\Model\IPurviewAble;

class DataPurviewTest extends TestCase
{
    private $dataStub;

    protected function setUp(): void
    {
        $this->dataStub = $this->getMockBuilder(DataPurview::class)
                           ->setMethods(['fetchStaffPurview', 'operation'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->dataStub);
    }

    public function testExtendsPurview()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Purview\Model\Purview',
            $this->dataStub
        );
    }

    public function testFetch()
    {
        $staffPurview = array(IPurviewAble::COLUMN['RESOURCE_DATA'] => array(1));
        $this->dataStub->expects($this->exactly(1))->method('fetchStaffPurview')->willReturn($staffPurview);

        $result = $this->dataStub->fetch();

        $this->assertTrue($result);
    }

    protected function initOperation($method)
    {
        $this->dataStub->expects($this->exactly(1))->method('operation')->with($method)->willReturn(true);

        $result = $this->dataStub->$method();

        $this->assertTrue($result);
    }

    public function testAdd()
    {
        $this->initOperation('add');
    }

    public function testEnable()
    {
        $this->initOperation('enable');
    }

    public function testDisable()
    {
        $this->initOperation('disable');
    }

    public function testBatchUpload()
    {
        $this->initOperation('batchUpload');
    }

    public function testExport()
    {
        $this->initOperation('export');
    }

    public function testApprove()
    {
        $dataExamineColumn = IPurviewAble::COLUMN['RESOURCE_DATA_EXAMINE'];
        $this->dataStub->expects($this->exactly(1))->method(
            'operation'
        )->with('approve', $dataExamineColumn)->willReturn(true);

        $result = $this->dataStub->approve();

        $this->assertTrue($result);
    }

    public function testReject()
    {
        $dataExamineColumn = IPurviewAble::COLUMN['RESOURCE_DATA_EXAMINE'];
        $this->dataStub->expects($this->exactly(1))->method(
            'operation'
        )->with('reject', $dataExamineColumn)->willReturn(true);

        $result = $this->dataStub->reject();

        $this->assertTrue($result);
    }
}
