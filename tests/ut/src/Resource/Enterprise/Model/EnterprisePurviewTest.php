<?php
namespace Sdk\Resource\Enterprise\Model;

use PHPUnit\Framework\TestCase;

class EnterprisePurviewTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(EnterprisePurview::class)
                           ->setMethods(['operation'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsPurview()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Purview\Model\Purview',
            $this->stub
        );
    }

    protected function initOperation($method)
    {
        $this->stub->expects($this->exactly(1))->method('operation')->with($method)->willReturn(true);

        $result = $this->stub->$method();

        $this->assertTrue($result);
    }

    public function testAuthorize()
    {
        $this->initOperation('authorize');
    }

    public function testUnAuthorize()
    {
        $this->initOperation('unAuthorize');
    }
}
