<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Adapter\HomePageConfig;

use PHPUnit\Framework\TestCase;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;

class HomePageConfigMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new HomePageConfigMockAdapter();
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

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig',
            $this->stub->fetchObject(1)
        );
    }

    public function testCurrent()
    {
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig',
            $this->stub->current(1)
        );
    }

    public function testPublish()
    {
        $homePageConfig = new HomePageConfig(1);

        $this->assertTrue($this->stub->publish($homePageConfig));
    }
}
