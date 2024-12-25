<?php
namespace Sdk\Common\Repository\Traits;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\MockObject;
use Sdk\Common\Adapter\Interfaces\ITopAbleAdapter;

class TopAbleRepositoryTraitTest extends TestCase
{
    private $stub;
    private $object;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(TopAbleRepositoryTraitMock::class)
                           ->setMethods(['getAdapter'])
                           ->getMock();
        $this->object = new MockObject(1);
    }

    protected function tearDown(): void
    {
        unset($this->stub);
        unset($this->object);
    }

    public function testTop()
    {
        // 为 ITopAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(ITopAbleAdapter::class);
        // 建立预期状况:top() 方法将会被调用一次。
        $adapter->top($this->object)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->topPublic($this->object);

        $this->assertTrue($result);
    }

    public function testCancelTop()
    {
        // 为 ITopAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(ITopAbleAdapter::class);
        // 建立预期状况:cancelTop() 方法将会被调用一次。
        $adapter->cancelTop($this->object)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->cancelTopPublic($this->object);

        $this->assertTrue($result);
    }
}
