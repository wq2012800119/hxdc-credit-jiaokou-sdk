<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Repository;

use PHPUnit\Framework\TestCase;

class HelpPageConfigRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new HelpPageConfigRepository();
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
            'Sdk\WebsiteConfig\HelpPageConfig\Adapter\HelpPageConfig\HelpPageConfigRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HelpPageConfig\Adapter\HelpPageConfig\HelpPageConfigMockAdapter',
            $this->stub->getMockAdapter()
        );
    }
}
