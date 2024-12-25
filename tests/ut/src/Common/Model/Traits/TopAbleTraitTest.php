<?php
namespace Sdk\Common\Model\Traits;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\Interfaces\ITopAble;
use Sdk\Common\Adapter\Interfaces\ITopAbleAdapter;

class TopAbleTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(TopAbleTraitMock::class)
                           ->setMethods(['getRepository', 'isTopStatus'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    //topStatus 测试 ------------------------------------------------------ start
    /**
     * @dataProvider additionProviderTopStatus
     */
    public function testSetTopStatus($parameter, $expected)
    {
        $this->stub->setTopStatus($parameter);
        $this->assertEquals($expected, $this->stub->getTopStatus());
    }

    /**
     * 循环测试 setTopStatus() 数据构建器
     */
    public function additionProviderTopStatus()
    {
        return array(
            array(ITopAble::TOP_STATUS['NO_TOP'], ITopAble::TOP_STATUS['NO_TOP']),
            array(ITopAble::TOP_STATUS['TOP'], ITopAble::TOP_STATUS['TOP']),
            array(9999, ITopAble::TOP_STATUS['NO_TOP']),
        );
    }
    /**
     * 设置 setTopStatus() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetTopStatusWrongType()
    {
        $this->stub->setTopStatus('string');
    }
    //topStatus 测试 ------------------------------------------------------   end

    private function operation(string $method)
    {
        // 为 ITopAbleAdapter 类建立预言(prophecy)。
        $repository = $this->prophesize(ITopAbleAdapter::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $repository->$method($this->stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getRepository() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());
    }

    public function testTopFalse()
    {
        $this->stub->expects($this->exactly(1))->method('isTopStatus')->willReturn(true);

        $result = $this->stub->topPublic();

        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_CAN_NOT_MODIFY, Core::getLastError()->getId());
    }

    public function testTopTrue()
    {
        $this->stub->expects($this->exactly(1))->method('isTopStatus')->willReturn(false);
        $this->operation('top');
        $result = $this->stub->topPublic();

        $this->assertTrue($result);
    }

    public function testCancelTopFalse()
    {
        $this->stub->expects($this->exactly(1))->method('isTopStatus')->willReturn(false);

        $result = $this->stub->cancelTopPublic();

        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_CAN_NOT_MODIFY, Core::getLastError()->getId());
    }

    public function testCancelTopTrue()
    {
        $this->stub->expects($this->exactly(1))->method('isTopStatus')->willReturn(true);

        $this->operation('cancelTop');
        $result = $this->stub->cancelTopPublic();

        $this->assertTrue($result);
    }

    public function testIsTopStatus()
    {
        $stub = new TopAbleTraitMock();

        $stub->setTopStatus(ITopAble::TOP_STATUS['TOP']);

        $result = $stub->isTopStatusPublic();

        $this->assertTrue($result);
    }
}
