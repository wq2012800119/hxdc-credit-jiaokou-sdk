<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Adapter\HelpPageConfig;

use PHPUnit\Framework\TestCase;

class HelpPageConfigMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new HelpPageConfigMockAdapter();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIHelpPageConfigAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HelpPageConfig\Adapter\HelpPageConfig\IHelpPageConfigAdapter',
            $this->stub
        );
    }

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HelpPageConfig\Model\HelpPageConfig',
            $this->stub->fetchObject(1)
        );
    }
}
