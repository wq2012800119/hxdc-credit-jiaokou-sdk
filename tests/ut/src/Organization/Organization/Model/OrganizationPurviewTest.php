<?php
namespace Sdk\Organization\Organization\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class OrganizationPurviewTest extends TestCase
{
    private $organizationStub;

    protected function setUp(): void
    {
        $this->organizationStub = $this->getMockBuilder(OrganizationPurview::class)
                                    ->setMethods(['operation'])
                                    ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->organizationStub);
    }

    public function testExtendsPurview()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Purview\Model\Purview',
            $this->organizationStub
        );
    }

    public function testAdd()
    {
        $this->organizationStub->expects($this->exactly(1))->method('operation')->with('add')->willReturn(true);

        $result = $this->organizationStub->add();

        $this->assertTrue($result);
    }

    public function testEdit()
    {
        $this->organizationStub->expects($this->exactly(1))->method('operation')->with('edit')->willReturn(true);

        $result = $this->organizationStub->edit();

        $this->assertTrue($result);
    }
}
