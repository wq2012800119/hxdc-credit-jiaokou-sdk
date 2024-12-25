<?php
namespace Sdk\User\Staff\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class StaffPurviewTest extends TestCase
{
    private $staffStub;

    protected function setUp(): void
    {
        $this->staffStub = $this->getMockBuilder(StaffPurview::class)
                           ->setMethods(['operation'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->staffStub);
    }

    public function testExtendsPurview()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Purview\Model\Purview',
            $this->staffStub
        );
    }

    protected function initOperation($method)
    {
        $this->staffStub->expects($this->exactly(1))->method('operation')->with($method)->willReturn(true);

        $result = $this->staffStub->$method();

        $this->assertTrue($result);
    }

    public function testAdd()
    {
        $this->initOperation('add');
    }

    public function testEdit()
    {
        $this->initOperation('edit');
    }
    
    public function testEnable()
    {
        $this->initOperation('enable');
    }

    public function testDisable()
    {
        $this->initOperation('disable');
    }

    public function testResetPassword()
    {
        $this->initOperation('resetPassword');
    }
}
