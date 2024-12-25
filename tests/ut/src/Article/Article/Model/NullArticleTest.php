<?php
namespace Sdk\Article\Article\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullArticleTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullArticle::getInstance();
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

    public function testExtendsArticle()
    {
        $this->assertInstanceOf(
            'Sdk\Article\Article\Model\Article',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullArticleMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }
}
