<?php
namespace Sdk\Common\Adapter\Traits;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\MockObject;

class FetchAbleMockAdapterTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(FetchAbleMockAdapterTraitMock::class)
                           ->setMethods(['fetchObject'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testFetchOne()
    {
        $id = 1;
        $object = new MockObject($id);
         // 为 filterAction() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('fetchObject')->with($id)->willReturn($object);

        $result = $this->stub->fetchOnePublic($id);

        $this->assertEquals($result, $object);
    }

    public function testFetchList()
    {
        $id = 1;
        $ids = array($id);
        $object = new MockObject($id);
        $list = array($object);
         // 为 filterAction() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('fetchObject')->with($id)->willReturn($object);

        $result = $this->stub->fetchListPublic($ids);

        $this->assertEquals($result, $list);
    }

    public function testSearch()
    {
        $stub = $this->getMockBuilder(FetchAbleMockAdapterTraitMock::class)
                           ->setMethods(['fetchList'])
                           ->getMock();

        $filter = $sort = array();
        $offset = 1;
        $size = 2;

        $id = 1;
        $ids = array($id);
        $object = new MockObject($id);
        $list = array($object);

         // 为 fetchList() 方法建立预期：该方法被调用一次且返回true。
        $stub->expects($this->exactly(1))->method('fetchList')->with($ids)->willReturn($list);

        $result = $stub->searchPublic($filter, $sort, $offset, $size);

        $this->assertEquals($result, [$list, count($list)]);
    }

    public function testFetchOneAsync()
    {
        $id = 1;
        $object = new MockObject($id);
         // 为 filterAction() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('fetchObject')->with($id)->willReturn($object);

        $result = $this->stub->fetchOneAsyncPublic($id);

        $this->assertEquals($result, $object);
    }

    public function testFetchListAsync()
    {
        $id = 1;
        $ids = array($id);
        $object = new MockObject($id);
        $list = array($object);
         // 为 filterAction() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('fetchObject')->with($id)->willReturn($object);

        $result = $this->stub->fetchListAsyncPublic($ids);

        $this->assertEquals($result, $list);
    }

    public function testSearchAsync()
    {
        $stub = $this->getMockBuilder(FetchAbleMockAdapterTraitMock::class)
                           ->setMethods(['fetchListAsync'])
                           ->getMock();

        $id = 1;
        $ids = array($id);
        $object = new MockObject($id);
        $list = array($object);

        $filter = $sort = array();
        $offset = 1;
        $size = 2;

         // 为 fetchListAsync() 方法建立预期：该方法被调用一次且返回true。
        $stub->expects($this->exactly(1))->method('fetchListAsync')->with($ids)->willReturn($list);

        $result = $stub->searchAsyncPublic($filter, $sort, $offset, $size);

        $this->assertEquals($result, [$list, count($list)]);
    }
}
