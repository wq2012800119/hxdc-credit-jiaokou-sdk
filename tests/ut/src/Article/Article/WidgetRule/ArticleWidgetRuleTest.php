<?php
namespace Sdk\Article\Article\WidgetRule;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Article\Article\Model\Article;
use Sdk\Common\Utils\Traits\CharacterGeneratorTrait;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ArticleWidgetRuleTest extends TestCase
{
    use CharacterGeneratorTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ArticleWidgetRule();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testGetCommonWidgetRule()
    {
        $stub = new ArticleWidgetRuleMock();
        $this->assertInstanceOf(
            'Sdk\Common\WidgetRule\CommonWidgetRule',
            $stub->getCommonWidgetRulePublic()
        );
    }

    //source
    /**
     * @dataProvider additionProviderSource
     */
    public function testSource($parameter, $expected)
    {
        $result = $this->stub->source($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ARTICLE_SOURCE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderSource()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(ArticleWidgetRule::SOURCE_MIN_LENGTH), true),
            array($this->randomChar(ArticleWidgetRule::SOURCE_MIN_LENGTH-1), false),
            array($this->randomChar(ArticleWidgetRule::SOURCE_MAX_LENGTH), true),
            array($this->randomChar(ArticleWidgetRule::SOURCE_MAX_LENGTH+1), false)
        );
    }

    //pubDate
    /**
     * @dataProvider additionProviderPubDate
     */
    public function testPubDate($parameter, $expected)
    {
        $result = $this->stub->pubDate($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ARTICLE_PUB_DATE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderPubDate()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->dateTime(), false),
            array($faker->unixTime(), true)
        );
    }

    //attachments
    /**
     * @dataProvider additionProviderAttachments
     */
    public function testAttachments($parameter, $expected, $errorCode)
    {
        $result = $this->stub->attachments($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals($errorCode, Core::getLastError()->getId());
    }

    public function additionProviderAttachments()
    {
        return array(
            array('', false, ARTICLE_ATTACHMENTS_FORMAT_INCORRECT),
            array(array(1, 2, 3, 4, 5, 6), false, ARTICLE_ATTACHMENTS_COUNT_INCORRECT),
            array(array(array('name' => 'name', 'address' => '1.jpg')), false, ARTICLE_ATTACHMENTS_FORMAT_INCORRECT),
            array(array(array('name' => 'name', 'address' => '1.doc')), true, '')
        );
    }

    //content
    /**
     * @dataProvider additionProviderContent
     */
    public function testContent($parameter, $expected, $errorCode)
    {
        $result = $this->stub->content($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals($errorCode, Core::getLastError()->getId());
    }

    public function additionProviderContent()
    {
        return array(
            array('', false, CONTENT_FORMAT_INCORRECT),
            array(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11), false, ARTICLE_CONTENT_COUNT_INCORRECT),
            array(array(array('type' => 'name', 'address' => '1.doc')), false, CONTENT_FORMAT_INCORRECT),
            array(array(array('type' => 'name', 'value' => '1.doc')), false, CONTENT_FORMAT_INCORRECT),
            array(array(array('type' => 'text', 'value' => '内容')), true, ''),
            array(array(array('type' => 'text', 'value' => '')), false, CONTENT_FORMAT_INCORRECT),
        );
    }

    //isSlides
    /**
     * @dataProvider additionProviderIsSlides
     */
    public function testIsSlides($parameter, $expected)
    {
        $result = $this->stub->isSlides($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ARTICLE_IS_SLIDES_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderIsSlides()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(Article::IS_SLIDES['NO'], true),
        );
    }

    //isHomeSlides
    /**
     * @dataProvider additionProviderIsHomeSlides
     */
    public function testIsHomeSlides($parameterOne, $parameterTwo, $expected)
    {
        $result = $this->stub->isHomeSlides($parameterOne, $parameterTwo);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ARTICLE_IS_HOME_SLIDES_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderIsHomeSlides()
    {
        return array(
            array('', '', false),
            array(array(1), '', false),
            array(Article::IS_HOME_SLIDES['NO'], Article::IS_SLIDES['NO'], true),
            array(Article::IS_HOME_SLIDES['YES'], Article::IS_SLIDES['NO'], false)
        );
    }

    //slidesPicture
    /**
     * @dataProvider additionProviderSlidesPicture
     */
    public function testSlidesPicture($parameterOne, $parameterTwo, $expected)
    {
        $result = $this->stub->slidesPicture($parameterOne, $parameterTwo);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(PICTURE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderSlidesPicture()
    {
        return array(
            array('', '', false),
            array(array(1), Article::IS_SLIDES['NO'], false),
            array(array(1), Article::IS_SLIDES['YES'], false),
            array(array('name' => 'name', 'value' => 'value'), Article::IS_SLIDES['YES'], false),
            array(array('name' => 'name', 'address' => 'address.jpg'), Article::IS_SLIDES['YES'], true)
        );
    }
}
