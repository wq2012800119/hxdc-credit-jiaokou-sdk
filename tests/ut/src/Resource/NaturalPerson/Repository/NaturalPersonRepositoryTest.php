<?php
namespace Sdk\Resource\NaturalPerson\Repository;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\NaturalPerson\Model\NaturalPerson;
use Sdk\Resource\NaturalPerson\Adapter\NaturalPerson\INaturalPersonAdapter;

class NaturalPersonRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(NaturalPersonRepository::class)
                           ->setMethods(['getAdapter'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsINaturalPersonAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\NaturalPerson\Adapter\NaturalPerson\INaturalPersonAdapter',
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
            'Sdk\Resource\NaturalPerson\Adapter\NaturalPerson\NaturalPersonRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\NaturalPerson\Adapter\NaturalPerson\NaturalPersonMockAdapter',
            $this->stub->getMockAdapter()
        );
    }

    protected function initOperation($method)
    {
        $naturalPerson = new NaturalPerson(1);
        // 为 INaturalPersonAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(INaturalPersonAdapter::class);
        // 建立预期状况:$method() 方法将会被调用一次。
        $adapter->$method($naturalPerson)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $this->stub->$method($naturalPerson);

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
