<?php
namespace Sdk\Article\Article\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Role\Purview\Model\IPurviewAble;

class ArticlePurviewTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(ArticlePurview::class)
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
        $staffPurview = array(IPurviewAble::COLUMN['ARTICLE'] => array(1));
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

    public function testTop()
    {
        $this->initOperation('top');
    }

    public function testCancelTop()
    {
        $this->initOperation('cancelTop');
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

    public function testApprove()
    {
        $articleExamineColumn = IPurviewAble::COLUMN['ARTICLE_EXAMINE'];
        $this->stub->expects($this->exactly(1))->method(
            'operation'
        )->with('approve', $articleExamineColumn)->willReturn(true);

        $result = $this->stub->approve();

        $this->assertTrue($result);
    }

    public function testReject()
    {
        $articleExamineColumn = IPurviewAble::COLUMN['ARTICLE_EXAMINE'];
        $this->stub->expects($this->exactly(1))->method(
            'operation'
        )->with('reject', $articleExamineColumn)->willReturn(true);

        $result = $this->stub->reject();

        $this->assertTrue($result);
    }
}
