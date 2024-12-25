<?php
namespace Sdk\User\Member\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class MemberPurviewTest extends TestCase
{
    private $memberStub;

    protected function setUp(): void
    {
        $this->memberStub = $this->getMockBuilder(MemberPurview::class)
                           ->setMethods(['operation'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->memberStub);
    }

    public function testExtendsPurview()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Purview\Model\Purview',
            $this->memberStub
        );
    }

    protected function initOperation($method)
    {
        $this->memberStub->expects($this->exactly(1))->method('operation')->with($method)->willReturn(true);

        $result = $this->memberStub->$method();

        $this->assertTrue($result);
    }

    public function testEnable()
    {
        $this->initOperation('enable');
    }

    public function testDisable()
    {
        $this->initOperation('disable');
    }
}
