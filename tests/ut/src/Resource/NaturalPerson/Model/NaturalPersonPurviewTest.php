<?php
namespace Sdk\Resource\NaturalPerson\Model;

use PHPUnit\Framework\TestCase;

class NaturalPersonPurviewTest extends TestCase
{
    private $naturalPersonStub;

    protected function setUp(): void
    {
        $this->naturalPersonStub = $this->getMockBuilder(NaturalPersonPurview::class)
                           ->setMethods(['operation'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->naturalPersonStub);
    }

    public function testExtendsPurview()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Purview\Model\Purview',
            $this->naturalPersonStub
        );
    }

    protected function initOperation($method)
    {
        $this->naturalPersonStub->expects($this->exactly(1))->method('operation')->with($method)->willReturn(true);

        $result = $this->naturalPersonStub->$method();

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
