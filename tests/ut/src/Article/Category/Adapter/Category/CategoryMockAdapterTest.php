<?php
namespace Sdk\Article\Category\Adapter\Category;

use PHPUnit\Framework\TestCase;
use Sdk\Article\Category\Model\Category;

class CategoryMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new CategoryMockAdapter();
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

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Article\Category\Model\Category',
            $this->stub->fetchObject(1)
        );
    }

    public function testDiy()
    {
        $category = new Category(1);

        $this->assertTrue($this->stub->diy($category));
    }
}
