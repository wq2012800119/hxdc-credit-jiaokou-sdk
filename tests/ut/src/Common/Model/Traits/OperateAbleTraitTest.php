<?php
namespace Sdk\Common\Model\Traits;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\Interfaces\IOperateAble;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;

class OperateAbleTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(OperateAbleTraitMock::class)
                           ->setMethods(['getRepository', 'isEnableStatus'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }
    //status 测试 ------------------------------------------------------ start
    /**
     * @dataProvider additionProvidetStatus
     */
    public function testSetStatus($parameter, $expected)
    {
        $this->stub->setStatus($parameter);
        $this->assertEquals($expected, $this->stub->getStatus());
    }

    /**
     * 循环测试 setStatus() 数据构建器
     */
    public function additionProvidetStatus()
    {
        return array(
            array(IOperateAble::STATUS['ENABLED'], IOperateAble::STATUS['ENABLED']),
            array(IOperateAble::STATUS['DISABLED'], IOperateAble::STATUS['DISABLED']),
        );
    }
    /**
     * 设置 setStatus() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStatusWrongType()
    {
        $this->stub->setStatus('string');
    }
    //status 测试 ------------------------------------------------------   end

    private function operation(string $method)
    {
        // 为 IOperateAbleAdapter 类建立预言(prophecy)。
        $repository = $this->prophesize(IOperateAbleAdapter::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $repository->$method($this->stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getRepository() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());
    }

    public function testInsert()
    {
        $this->operation('insert');
        $result = $this->stub->insertPublic();

        $this->assertTrue($result);
    }

    public function testUpdate()
    {
        $this->operation('update');
        $result = $this->stub->updatePublic();

        $this->assertTrue($result);
    }

    public function testEnableFalse()
    {
        $this->stub->expects($this->exactly(1))->method('isEnableStatus')->willReturn(true);

        $result = $this->stub->enablePublic();

        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_CAN_NOT_MODIFY, Core::getLastError()->getId());
    }

    public function testEnableTrue()
    {
        $this->stub->expects($this->exactly(1))->method('isEnableStatus')->willReturn(false);
        $this->operation('enable');
        $result = $this->stub->enablePublic();

        $this->assertTrue($result);
    }

    public function testDisableFalse()
    {
        $this->stub->expects($this->exactly(1))->method('isEnableStatus')->willReturn(false);

        $result = $this->stub->disablePublic();

        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_CAN_NOT_MODIFY, Core::getLastError()->getId());
    }

    public function testDisableTrue()
    {
        $this->stub->expects($this->exactly(1))->method('isEnableStatus')->willReturn(true);

        $this->operation('disable');
        $result = $this->stub->disablePublic();

        $this->assertTrue($result);
    }

    public function testIsEnableStatus()
    {
        $stub = new OperateAbleTraitMock();

        $stub->setStatus(IOperateAble::STATUS['ENABLED']);

        $result = $stub->isEnableStatusPublic();

        $this->assertTrue($result);
    }
}
