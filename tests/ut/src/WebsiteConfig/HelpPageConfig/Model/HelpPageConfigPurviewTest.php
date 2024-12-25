<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class HelpPageConfigPurviewTest extends TestCase
{
    private $configStub;

    protected function setUp(): void
    {
        $this->configStub = $this->getMockBuilder(HelpPageConfigPurview::class)->setMethods(['operation'])->getMock();
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

    public function testEdit()
    {
        $this->configStub->expects($this->exactly(1))->method('operation')->with('edit')->willReturn(true);

        $result = $this->configStub->edit();

        $this->assertTrue($result);
    }
}
