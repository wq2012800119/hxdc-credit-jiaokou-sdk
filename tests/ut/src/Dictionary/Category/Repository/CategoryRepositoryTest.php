<?php
namespace Sdk\Dictionary\Category\Repository;

use PHPUnit\Framework\TestCase;

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
            'Sdk\Dictionary\Category\Adapter\Category\ICategoryAdapter',
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
            'Sdk\Dictionary\Category\Adapter\Category\CategoryRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Dictionary\Category\Adapter\Category\CategoryMockAdapter',
            $this->stub->getMockAdapter()
        );
    }
}
