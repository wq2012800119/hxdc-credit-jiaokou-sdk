<?php
namespace Sdk\Role\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class RolePurviewTest extends TestCase
{
    private $roleStub;

    protected function setUp(): void
    {
        $this->roleStub = $this->getMockBuilder(RolePurview::class)->setMethods(['operation'])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->roleStub);
    }

    public function testExtendsPurview()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Purview\Model\Purview',
            $this->roleStub
        );
    }

    public function testAdd()
    {
        $this->roleStub->expects($this->exactly(1))->method('operation')->with('add')->willReturn(true);

        $result = $this->roleStub->add();

        $this->assertTrue($result);
    }

    public function testEdit()
    {
        $this->roleStub->expects($this->exactly(1))->method('operation')->with('edit')->willReturn(true);

        $result = $this->roleStub->edit();

        $this->assertTrue($result);
    }
}
