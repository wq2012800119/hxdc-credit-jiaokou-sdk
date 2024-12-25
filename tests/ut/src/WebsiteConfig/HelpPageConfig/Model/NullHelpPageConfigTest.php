<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullHelpPageConfigTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullHelpPageConfig::getInstance();
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

    public function testExtendsHelpPageConfig()
    {
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HelpPageConfig\Model\HelpPageConfig',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullHelpPageConfigMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }
}
