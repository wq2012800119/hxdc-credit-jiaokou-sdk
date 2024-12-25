<?php
namespace Sdk\Common\Adapter\Traits;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\MockObject;
use Sdk\Common\Model\NullMockObject;

class FetchAbleRestfulAdapterTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(FetchAbleRestfulAdapterTraitMock::class)
                           ->setMethods([
                               'get',
                               'getResource',
                               'isSuccess',
                               'translateToObject',
                               'getNullObject',
                               'translateToObjects',
                               'getAsync'
                            ])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    private function fetchOne(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        
        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('get')->with($resource.'/'.$id);
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);
    }

    public function testFetchOneTrue()
    {
        $id = 1;
        $object = new MockObject($id);
        $this->fetchOne(true);
        $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($object);

        $result = $this->stub->fetchOnePublic($id);

        $this->assertEquals($result, $object);
    }

    public function testFetchOneFalse()
    {
        $id = 1;
        $nullObject = NullMockObject::getInstance();
        $this->fetchOne(false);
        $this->stub->expects($this->exactly(1))->method('getNullObject')->willReturn($nullObject);

        $result = $this->stub->fetchOnePublic($id);

        $this->assertEquals($result, $nullObject);
    }

    private function fetchList(bool $result)
    {
        $ids = array(1);
        $resource = 'resource';
        
        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('get')->with($resource.'/'.implode(',', $ids));
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);
    }

    public function testFetchListTrue()
    {
        $ids = array(1);
        $list = array(1, new MockObject(1));

        $this->fetchList(true);
        $this->stub->expects($this->exactly(1))->method('translateToObjects')->willReturn($list);

        $result = $this->stub->fetchListPublic($ids);

        $this->assertEquals($result, $list);
    }

    public function testFetchListFalse()
    {
        $ids = array(1);
        $this->fetchList(false);

        $result = $this->stub->fetchListPublic($ids);

        $this->assertEquals($result, array(0, array()));
    }

    private function search(bool $result)
    {
        $filter = $sort = array();
        $number = 1;
        $size = 1;
        $resource = 'resource';
        
        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('get')->with(
            $resource,
            array(
                'filter'=>$filter,
                'sort'=>implode(',', $sort),
                'size'=>$size,
                'page'=>$number
            )
        );
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        return [$filter, $sort, $number, $size];
    }

    public function testSearchTrue()
    {
        $list = array(1, new MockObject(1));

        list($filter, $sort, $number, $size) = $this->search(true);
        $this->stub->expects($this->exactly(1))->method('translateToObjects')->willReturn($list);

        $result = $this->stub->searchPublic($filter, $sort, $number, $size);

        $this->assertEquals($result, $list);
    }

    public function testSearchFalse()
    {
        list($filter, $sort, $number, $size) = $this->search(false);

        $result = $this->stub->searchPublic($filter, $sort, $number, $size);

        $this->assertEquals($result, array(0, array()));
    }

    public function testFetchOneAsync()
    {
        $id = 1;
        $object = new MockObject($id);
        $resource = 'resource';

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('getAsync')->with($resource.'/'.$id)->willReturn($object);

        $result = $this->stub->fetchOneAsyncPublic($id);

        $this->assertEquals($result, $object);
    }

    public function testFetchListAsync()
    {
        $ids = array(1);
        $list = array(new MockObject(1));
        $resource = 'resource';

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method(
            'getAsync'
        )->with($resource.'/'.implode(',', $ids))->willReturn($list);

        $result = $this->stub->fetchListAsyncPublic($ids);

        $this->assertEquals($result, $list);
    }

    public function testSearchAsync()
    {
        $filter = $sort = array();
        $number = $size = 1;
        $list = array(new MockObject(1));
        $resource = 'resource';

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('getAsync')->with(
            $resource,
            array(
                'filter'=>$filter,
                'sort'=>implode(',', $sort),
                'size'=>$size,
                'page'=>$number
            )
        )->willReturn($list);

        $result = $this->stub->searchAsyncPublic($filter, $sort, $number, $size);

        $this->assertEquals($result, $list);
    }
}
