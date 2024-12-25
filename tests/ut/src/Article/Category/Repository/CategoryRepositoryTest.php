<?php
namespace Sdk\Article\Category\Repository;

use PHPUnit\Framework\TestCase;

use Sdk\Article\Category\Model\Category;
use Sdk\Article\Category\Adapter\Category\ICategoryAdapter;

class CategoryRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new CategoryRepository();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsICategoryAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Article\Category\Adapter\Category\ICategoryAdapter',
            $this->stub
        );
    }

    public function testExtendsCommonRepository()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Repository\CommonRepository',
            $this->stub
        );
    }

    public function testGetActualAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Article\Category\Adapter\Category\CategoryRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Article\Category\Adapter\Category\CategoryMockAdapter',
            $this->stub->getMockAdapter()
        );
    }

    public function testDiy()
    {
        $stub = $this->getMockBuilder(CategoryRepository::class)->setMethods(['getAdapter'])->getMock();

        $category = new Category(1);
        // 为 ICategoryAdapter 类建立预言(prophecy)。
        $adapter = $this->prophesize(ICategoryAdapter::class);
        // 建立预期状况:diy() 方法将会被调用一次。
        $adapter->diy($category)->shouldBeCalled(1)->willReturn(true);
        // 为 getAdapter() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method('getAdapter')->willReturn($adapter->reveal());

        $result = $stub->diy($category);
        $this->assertTrue($result);
    }
}
