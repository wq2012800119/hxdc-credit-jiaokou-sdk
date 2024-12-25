<?php
namespace Sdk\Dictionary\Category\Model;

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
            'Sdk\Dictionary\Category\Model\Category',
            $this->stub
        );
    }
}
