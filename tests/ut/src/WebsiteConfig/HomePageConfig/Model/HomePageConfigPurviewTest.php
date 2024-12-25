<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class HomePageConfigPurviewTest extends TestCase
{
    private $configStub;

    protected function setUp(): void
    {
        $this->configStub = $this->getMockBuilder(HomePageConfigPurview::class)->setMethods(['operation'])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->configStub);
    }

    public function testExtendsPurview()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Purview\Model\Purview',
            $this->configStub
        );
    }

    public function testAdd()
    {
        $this->configStub->expects($this->exactly(1))->method('operation')->with('add')->willReturn(true);

        $result = $this->configStub->add();

        $this->assertTrue($result);
    }

    public function testPublish()
    {
        $this->configStub->expects($this->exactly(1))->method('operation')->with('publish')->willReturn(true);

        $result = $this->configStub->publish();

        $this->assertTrue($result);
    }
}
