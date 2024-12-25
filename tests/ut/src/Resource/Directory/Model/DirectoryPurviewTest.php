<?php
namespace Sdk\Resource\Directory\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Role\Purview\Model\IPurviewAble;

class DirectoryPurviewTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(DirectoryPurview::class)
                           ->setMethods(['fetchStaffPurview', 'operation'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsPurview()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Purview\Model\Purview',
            $this->stub
        );
    }

    public function testFetch()
    {
        $staffPurview = array(IPurviewAble::COLUMN['RESOURCE_DIRECTORY'] => array(1));
        $this->stub->expects($this->exactly(1))->method('fetchStaffPurview')->willReturn($staffPurview);

        $result = $this->stub->fetch();

        $this->assertTrue($result);
    }

    protected function initOperation($method)
    {
        $this->stub->expects($this->exactly(1))->method('operation')->with($method)->willReturn(true);

        $result = $this->stub->$method();

        $this->assertTrue($result);
    }

    public function testEnable()
    {
        $this->initOperation('enable');
    }

    public function testDisable()
    {
        $this->initOperation('disable');
    }

    public function testAdd()
    {
        $this->initOperation('add');
    }

    public function testEdit()
    {
        $this->initOperation('edit');
    }

    public function testRollback()
    {
        $this->initOperation('rollback');
    }

    public function testApprove()
    {
        $directoryExamineColumn = IPurviewAble::COLUMN['RESOURCE_DIRECTORY_EXAMINE'];
        $this->stub->expects($this->exactly(1))->method(
            'operation'
        )->with('approve', $directoryExamineColumn)->willReturn(true);

        $result = $this->stub->approve();

        $this->assertTrue($result);
    }

    public function testReject()
    {
        $directoryExamineColumn = IPurviewAble::COLUMN['RESOURCE_DIRECTORY_EXAMINE'];
        $this->stub->expects($this->exactly(1))->method(
            'operation'
        )->with('reject', $directoryExamineColumn)->willReturn(true);

        $result = $this->stub->reject();

        $this->assertTrue($result);
    }
}
