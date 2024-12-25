<?php
namespace Sdk\Common\Model\Traits;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\Interfaces\IExamineAble;
use Sdk\Common\Adapter\Interfaces\IExamineAbleAdapter;

class ExamineAbleTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(ExamineAbleTraitMock::class)
                           ->setMethods(['getRepository', 'isPendingExamineStatus'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    //examineStatus 测试 ------------------------------------------------------ start
    /**
     * @dataProvider additionProviderExamineStatus
     */
    public function testSetExamineStatus($parameter, $expected)
    {
        $this->stub->setExamineStatus($parameter);
        $this->assertEquals($expected, $this->stub->getExamineStatus());
    }

    /**
     * 循环测试 setExamineStatus() 数据构建器
     */
    public function additionProviderExamineStatus()
    {
        return array(
            array(IExamineAble::EXAMINE_STATUS['PENDING'], IExamineAble::EXAMINE_STATUS['PENDING']),
            array(IExamineAble::EXAMINE_STATUS['APPROVE'], IExamineAble::EXAMINE_STATUS['APPROVE']),
            array(IExamineAble::EXAMINE_STATUS['REJECT'], IExamineAble::EXAMINE_STATUS['REJECT']),
            array(9999, IExamineAble::EXAMINE_STATUS['PENDING']),
        );
    }
    /**
     * 设置 setExamineStatus() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetExamineStatusWrongType()
    {
        $this->stub->setExamineStatus('string');
    }
    //examineStatus 测试 ------------------------------------------------------   end

    private function operation(string $method)
    {
        // 为 IExamineAbleAdapter 类建立预言(prophecy)。
        $repository = $this->prophesize(IExamineAbleAdapter::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $repository->$method($this->stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getRepository() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());
    }

    public function testApproveFalse()
    {
        $this->stub->expects($this->exactly(1))->method('isPendingExamineStatus')->willReturn(false);

        $result = $this->stub->approvePublic();

        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_CAN_NOT_MODIFY, Core::getLastError()->getId());
    }

    public function testApproveTrue()
    {
        $this->stub->expects($this->exactly(1))->method('isPendingExamineStatus')->willReturn(true);
        $this->operation('approve');
        $result = $this->stub->approvePublic();

        $this->assertTrue($result);
    }

    public function testRejectFalse()
    {
        $this->stub->expects($this->exactly(1))->method('isPendingExamineStatus')->willReturn(false);

        $result = $this->stub->rejectPublic();

        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_CAN_NOT_MODIFY, Core::getLastError()->getId());
    }

    public function testRejectTrue()
    {
        $this->stub->expects($this->exactly(1))->method('isPendingExamineStatus')->willReturn(true);

        $this->operation('reject');
        $result = $this->stub->rejectPublic();

        $this->assertTrue($result);
    }

    public function testIsPendingExamineStatus()
    {
        $stub = new ExamineAbleTraitMock();

        $stub->setExamineStatus(IExamineAble::EXAMINE_STATUS['PENDING']);

        $result = $stub->isPendingExamineStatusPublic();

        $this->assertTrue($result);
    }
}
