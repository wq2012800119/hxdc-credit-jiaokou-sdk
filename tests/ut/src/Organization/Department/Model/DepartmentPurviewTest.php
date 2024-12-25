<?php
namespace Sdk\Organization\Department\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class DepartmentPurviewTest extends TestCase
{
    private $departmentStub;

    protected function setUp(): void
    {
        $this->departmentStub = $this->getMockBuilder(DepartmentPurview::class)->setMethods(['operation'])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->departmentStub);
    }

    public function testExtendsPurview()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Purview\Model\Purview',
            $this->departmentStub
        );
    }

    public function testAdd()
    {
        $this->departmentStub->expects($this->exactly(1))->method('operation')->with('add')->willReturn(true);

        $result = $this->departmentStub->add();

        $this->assertTrue($result);
    }

    public function testEdit()
    {
        $this->departmentStub->expects($this->exactly(1))->method('operation')->with('edit')->willReturn(true);

        $result = $this->departmentStub->edit();

        $this->assertTrue($result);
    }
}
