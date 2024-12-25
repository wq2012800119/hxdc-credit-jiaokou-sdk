<?php
namespace Sdk\Common\Repository\Traits;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\MockObject;
use Sdk\Common\Adapter\Interfaces\IExamineAbleAdapter;

class ExamineAbleRepositoryTraitTest extends TestCase
{
    private $stub;
    private $object;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(ExamineAbleRepositoryTraitMock::class)
                           ->setMethods(['getAdapter'])
                           ->getMock();
        $this->object = new MockObject(1);
    }

    protected function tearDown(): void
    {
        unset($this->stub);
        unset($this->object);
    }

    public function testApprove()
    {
        // 为 IExamineAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IExamineAbleAdapter::class);
        // 建立预期状况:approve() 方法将会被调用一次。
        $adapter->approve($this->object)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->approvePublic($this->object);

        $this->assertTrue($result);
    }

    public function testReject()
    {
        // 为 IExamineAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IExamineAbleAdapter::class);
        // 建立预期状况:reject() 方法将会被调用一次。
        $adapter->reject($this->object)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->rejectPublic($this->object);

        $this->assertTrue($result);
    }
}
