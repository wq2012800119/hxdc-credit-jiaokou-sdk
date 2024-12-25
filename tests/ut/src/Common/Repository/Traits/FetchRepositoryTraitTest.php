<?php
namespace Sdk\Common\Repository\Traits;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\MockObject;
use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;

class FetchRepositoryTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(FetchRepositoryTraitMock::class)
                           ->setMethods(['getAdapter'])
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

        // 为 IFetchAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IFetchAbleAdapter::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $adapter->fetchOne($id)->shouldBeCalled(1)->willReturn($object);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->fetchOnePublic($id);

        $this->assertEquals($result, $object);
    }

    public function testFetchList()
    {
        $ids = array(1);
        $list = array(new MockObject(1));

        // 为 IFetchAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IFetchAbleAdapter::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $adapter->fetchList($ids)->shouldBeCalled(1)->willReturn($list);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->fetchListPublic($ids);

        $this->assertEquals($result, $list);
    }

    public function testSearch()
    {
        $filter = $sort = array();
        $number = $size = 1;
        $list = array(new MockObject(1));

        // 为 IFetchAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IFetchAbleAdapter::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $adapter->search($filter, $sort, $number, $size)->shouldBeCalled(1)->willReturn($list);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->searchPublic($filter, $sort, $number, $size);

        $this->assertEquals($result, $list);
    }

    public function testFetchOneAsync()
    {
        $id = 1;
        $object = new MockObject($id);

        // 为 IFetchAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IFetchAbleAdapter::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $adapter->fetchOneAsync($id)->shouldBeCalled(1)->willReturn($object);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->fetchOneAsyncPublic($id);

        $this->assertEquals($result, $object);
    }

    public function testFetchOneAsyncEmpty()
    {
        $id = 1;
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn('');

        $result = $this->stub->fetchOneAsyncPublic($id);

        $this->assertEmpty($result);
    }

    public function testFetchListAsync()
    {
        $ids = array(1);
        $list = array(new MockObject(1));

        // 为 IFetchAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IFetchAbleAdapter::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $adapter->fetchListAsync($ids)->shouldBeCalled(1)->willReturn($list);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->fetchListAsyncPublic($ids);

        $this->assertEquals($result, $list);
    }

    public function testFetchListAsyncEmpty()
    {
        $ids = array(1);
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn('');

        $result = $this->stub->fetchListAsyncPublic($ids);

        $this->assertEmpty($result);
    }

    public function testSearchAsync()
    {
        $filter = $sort = array();
        $number = $size = 1;
        $list = array(new MockObject(1));

        // 为 IFetchAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IFetchAbleAdapter::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $adapter->searchAsync($filter, $sort, $number, $size)->shouldBeCalled(1)->willReturn($list);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->searchAsyncPublic($filter, $sort, $number, $size);

        $this->assertEquals($result, $list);
    }

    public function testSearchAsyncEmpty()
    {
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn('');

        $result = $this->stub->searchAsyncPublic();

        $this->assertEmpty($result);
    }
}
