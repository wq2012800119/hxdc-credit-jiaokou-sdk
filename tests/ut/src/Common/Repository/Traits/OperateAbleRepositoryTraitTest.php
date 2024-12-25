<?php
namespace Sdk\Common\Repository\Traits;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\MockObject;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;

class OperateAbleRepositoryTraitTest extends TestCase
{
    private $stub;
    private $object;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(OperateAbleRepositoryTraitMock::class)
                           ->setMethods(['getAdapter'])
                           ->getMock();
        $this->object = new MockObject(1);
    }

    protected function tearDown(): void
    {
        unset($this->stub);
        unset($this->object);
    }

    public function testInsert()
    {
        // 为 IOperateAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IOperateAbleAdapter::class);
        // 建立预期状况:insert() 方法将会被调用一次。
        $adapter->insert($this->object)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->insertPublic($this->object);

        $this->assertTrue($result);
    }

    public function testUpdate()
    {
        // 为 IOperateAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IOperateAbleAdapter::class);
        // 建立预期状况:update() 方法将会被调用一次。
        $adapter->update($this->object)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->updatePublic($this->object);

        $this->assertTrue($result);
    }

    public function testEnable()
    {
        // 为 IOperateAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IOperateAbleAdapter::class);
        // 建立预期状况:enable() 方法将会被调用一次。
        $adapter->enable($this->object)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->enablePublic($this->object);

        $this->assertTrue($result);
    }

    public function testDisable()
    {
        // 为 IOperateAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IOperateAbleAdapter::class);
        // 建立预期状况:disable() 方法将会被调用一次。
        $adapter->disable($this->object)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->disablePublic($this->object);

        $this->assertTrue($result);
    }
}
