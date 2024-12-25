<?php
namespace Sdk\Article\Category\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class CategoryPurviewTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(CategoryPurview::class)->setMethods(['operation'])->getMock();
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

    public function testAdd()
    {
        $this->stub->expects($this->exactly(1))->method('operation')->with('add')->willReturn(true);

        $result = $this->stub->add();

        $this->assertTrue($result);
    }

    public function testEdit()
    {
        $this->stub->expects($this->exactly(1))->method('operation')->with('edit')->willReturn(true);

        $result = $this->stub->edit();

        $this->assertTrue($result);
    }
}
