<?php
namespace Sdk\Article\Article\Repository;

use PHPUnit\Framework\TestCase;

class ArticleRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ArticleRepository();
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
            'Sdk\Article\Article\Adapter\Article\ArticleRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Article\Article\Adapter\Article\ArticleMockAdapter',
            $this->stub->getMockAdapter()
        );
    }
}
