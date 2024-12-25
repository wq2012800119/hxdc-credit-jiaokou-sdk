<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullHomePageConfigTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullHomePageConfig::getInstance();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsINull()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\INull',
            $this->stub
        );
    }

    public function testExtendsHomePageConfig()
    {
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullHomePageConfigMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }

    public function testPublish()
    {
        $stub = $this->getMockBuilder(NullHomePageConfig::class)->setMethods(['resourceNotExist'])->getMock();

        $stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $stub->publish();
        $this->assertFalse($result);
    }
}
