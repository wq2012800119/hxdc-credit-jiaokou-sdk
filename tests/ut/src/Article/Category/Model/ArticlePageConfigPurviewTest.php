<?php
namespace Sdk\Article\Category\Model;

use PHPUnit\Framework\TestCase;

class ArticlePageConfigPurviewTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(ArticlePageConfigPurview::class)->setMethods(['operation'])->getMock();
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

    public function testDiy()
    {
        $this->stub->expects($this->exactly(1))->method('operation')->with('diy')->willReturn(true);

        $result = $this->stub->diy();

        $this->assertTrue($result);
    }
}
