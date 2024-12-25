<?php
namespace Sdk\Article\Article\Adapter\Article;

use PHPUnit\Framework\TestCase;

class ArticleMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ArticleMockAdapter();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIArticleAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Article\Article\Adapter\Article\IArticleAdapter',
            $this->stub
        );
    }

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Article\Article\Model\Article',
            $this->stub->fetchObject(1)
        );
    }
}
