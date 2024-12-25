<?php
namespace Sdk\Article\Article\Adapter\Article;

use PHPUnit\Framework\TestCase;

class ArticleRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ArticleRestfulAdapterMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsCommonRestfulAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Adapter\CommonRestfulAdapter',
            $this->stub
        );
    }

    public function testImplementsIArticleAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Article\Article\Adapter\Article\IArticleAdapter',
            $this->stub
        );
    }

    public function testGetNullObject()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\INull',
            $this->stub->getNullObjectPublic()
        );

        $this->assertInstanceOf(
            'Sdk\Article\Article\Model\NullArticle',
            $this->stub->getNullObjectPublic()
        );
    }

    //scenario
    /**
     * @dataProvider additionProviderScenario
     */
    public function testScenario($scenario, $expect)
    {
        $this->stub->scenario($scenario);

        $this->assertEquals($expect, $this->stub->getScenario());
    }

    public function additionProviderScenario()
    {
        return array(
            array('ARTICLE_LIST', ArticleRestfulAdapter::SCENARIOS['ARTICLE_LIST']),
            array('ARTICLE_FETCH_ONE', ArticleRestfulAdapter::SCENARIOS['ARTICLE_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(ArticleRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    public function testInsertTranslatorKeys()
    {
        $this->assertEquals(array(
            'title',
            'source',
            'category',
            'pubDate',
            'description',
            'isSlides',
            'isHomeSlides',
            'slidesPicture',
            'cover',
            'attachments',
            'content',
            'staff'
        ), $this->stub->insertTranslatorKeysPublic());
    }

    public function testUpdateTranslatorKeys()
    {
        $this->assertEquals(array(
            'title',
            'source',
            'category',
            'pubDate',
            'description',
            'isSlides',
            'isHomeSlides',
            'slidesPicture',
            'cover',
            'attachments',
            'content'
        ), $this->stub->updateTranslatorKeysPublic());
    }
}
