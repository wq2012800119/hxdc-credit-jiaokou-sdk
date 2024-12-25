<?php
namespace Sdk\Article\Category\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullCategoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullCategory::getInstance();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsINull()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\INull',
            $this->stub
        );
    }

    public function testExtendsCategory()
    {
        $this->assertInstanceOf(
            'Sdk\Article\Category\Model\Category',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullCategoryMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }

    public function testDiy()
    {
        $stub = $this->getMockBuilder(NullCategoryMock::class)->setMethods(['resourceNotExist'])->getMock();

        $stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $stub->diy();
        $this->assertFalse($result);
    }
}
