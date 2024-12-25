<?php
namespace Sdk\Common\Repository;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Adapter\MockRestfulAdapter;

class CommonRepositoryTest extends TestCase
{
    private $stub;

    private $adapter;

    protected function setUp(): void
    {
        $this->adapter = new MockRestfulAdapter();
        $this->stub = $this->getMockBuilder(CommonRepository::class)
                           ->setConstructorArgs(array($this->adapter, $this->adapter))
                           ->setMethods(['getAdapter'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
        unset($this->adapter);
    }

    public function testExtendsRepository()
    {
        $this->assertInstanceOf(
            'Marmot\Framework\Classes\Repository',
            $this->stub
        );
    }

    public function testImplementsIAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter',
            $this->stub
        );

        $this->assertInstanceOf(
            'Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter',
            $this->stub
        );
    }

    public function testGetActualAdapter()
    {
        $result = $this->stub->getActualAdapter();

        $this->assertEquals($result, $this->adapter);
    }

    public function testGetMockAdapter()
    {
        $result = $this->stub->getMockAdapter();

        $this->assertEquals($result, $this->adapter);
    }

    public function testScenario()
    {
        $scenario = 'scenario';
        // 为 IOperateAbleAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(MockRestfulAdapter::class);
        // 建立预期状况:insert() 方法将会被调用一次。
        $adapter->scenario($scenario)->shouldBeCalled(1);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $this->stub->scenario($scenario);
    }
}
