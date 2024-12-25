<?php
namespace Sdk\Resource\Enterprise\Repository;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Enterprise\Model\Enterprise;
use Sdk\Resource\Enterprise\Adapter\Enterprise\IEnterpriseAdapter;

class EnterpriseRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(EnterpriseRepository::class)
                           ->setMethods(['getAdapter'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIEnterpriseAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Enterprise\Adapter\Enterprise\IEnterpriseAdapter',
            $this->stub
        );
    }

    public function testExtendsCommonRepository()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Repository\CommonRepository',
            $this->stub
        );
    }

    public function testGetActualAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Enterprise\Adapter\Enterprise\EnterpriseRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Enterprise\Adapter\Enterprise\EnterpriseMockAdapter',
            $this->stub->getMockAdapter()
        );
    }

    protected function initOperation($method)
    {
        $enterprise = new Enterprise(1);
        // 为 IEnterpriseAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IEnterpriseAdapter::class);
        // 建立预期状况:$method() 方法将会被调用一次。
        $adapter->$method($enterprise)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->$method($enterprise);

        $this->assertTrue($result);
    }

    public function testAuthorize()
    {
        $this->initOperation('authorize');
    }

    public function testUnAuthorize()
    {
        $this->initOperation('unAuthorize');
    }
}
