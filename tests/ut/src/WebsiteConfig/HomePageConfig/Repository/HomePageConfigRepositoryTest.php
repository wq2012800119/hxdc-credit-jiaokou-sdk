<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Repository;

use PHPUnit\Framework\TestCase;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;
use Sdk\WebsiteConfig\HomePageConfig\Adapter\HomePageConfig\IHomePageConfigAdapter;

class HomePageConfigRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new HomePageConfigRepository();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIHomePageConfigAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HomePageConfig\Adapter\HomePageConfig\IHomePageConfigAdapter',
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
            'Sdk\WebsiteConfig\HomePageConfig\Adapter\HomePageConfig\HomePageConfigRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HomePageConfig\Adapter\HomePageConfig\HomePageConfigMockAdapter',
            $this->stub->getMockAdapter()
        );
    }

    public function testPublish()
    {
        $stub = $this->getMockBuilder(HomePageConfigRepository::class)->setMethods(['getAdapter'])->getMock();

        $homePageConfig = new HomePageConfig(1);
        // 为 IHomePageConfigAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IHomePageConfigAdapter::class);
        // 建立预期状况:publish() 方法将会被调用一次。
        $adapter->publish($homePageConfig)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $stub->publish($homePageConfig);
        $this->assertTrue($result);
    }

    public function testCurrent()
    {
        $stub = $this->getMockBuilder(HomePageConfigRepository::class)->setMethods(['getAdapter'])->getMock();

        $homePageConfig = new HomePageConfig(1);
        // 为 IHomePageConfigAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(IHomePageConfigAdapter::class);
        // 建立预期状况:current() 方法将会被调用一次。
        $adapter->current()->shouldBeCalled(1)->willReturn($homePageConfig);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $stub->current();
        $this->assertEquals($result, $homePageConfig);
    }
}
