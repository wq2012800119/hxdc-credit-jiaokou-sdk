<?php
namespace Sdk\Dictionary\Category\Adapter\Category;

use PHPUnit\Framework\TestCase;

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
            'Sdk\Dictionary\Category\Adapter\Category\ICategoryAdapter',
            $this->stub
        );
    }

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Dictionary\Category\Model\Category',
            $this->stub->fetchObject(1)
        );
    }
}
