<?php
namespace Sdk\Dictionary\Item\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class DictionaryPurviewTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(DictionaryPurview::class)->setMethods(['operation'])->getMock();
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
}
