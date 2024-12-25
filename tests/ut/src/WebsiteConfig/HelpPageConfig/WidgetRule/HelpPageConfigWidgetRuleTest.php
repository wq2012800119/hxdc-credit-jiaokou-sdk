<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\WidgetRule;

use Marmot\Core;
use PHPUnit\Framework\TestCase;
use Sdk\Common\Utils\Traits\CharacterGeneratorTrait;

use Sdk\WebsiteConfig\HelpPageConfig\Model\HelpPageConfig;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class HelpPageConfigWidgetRuleTest extends TestCase
{
    use CharacterGeneratorTrait;

    private $stub;

    protected function setUp(): void
    {
        $this->stub = new HelpPageConfigWidgetRuleMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testGetCommonWidgetRule()
    {
        $this->assertInstanceOf(
            'Sdk\Common\WidgetRule\CommonWidgetRule',
            $this->stub->getCommonWidgetRulePublic()
        );
    }

    //title
    /**
     * @dataProvider additionProviderTitle
     */
    public function testTitle($parameter, $expected)
    {
        $result = $this->stub->title($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(TITLE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderTitle()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(HelpPageConfigWidgetRule::TITLE_MIN_LENGTH), true),
            array($this->randomChar(HelpPageConfigWidgetRule::TITLE_MIN_LENGTH-1), false),
            array($this->randomChar(HelpPageConfigWidgetRule::TITLE_MAX_LENGTH), true),
            array($this->randomChar(HelpPageConfigWidgetRule::TITLE_MAX_LENGTH+1), false)
        );
    }

    //style
    /**
     * @dataProvider additionProviderStyle
     */
    public function testStyle($parameter, $expected)
    {
        $result = $this->stub->style($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HELP_PAGE_CONFIG_STYLE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderStyle()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(HelpPageConfig::STYLE['STYLE_ONE'], true),
        );
    }

    public function testDiyContent()
    {
        $stub = $this->getMockBuilder(HelpPageConfigWidgetRule::class)
                           ->setMethods([
                               'diyContentTypeFormatValidate',
                               'diyContentFormatValidate'
                            ])->getMock();

        $diyContent = $style = array('diyContent');

        $stub->expects($this->once())->method('diyContentTypeFormatValidate')->with($diyContent)->willReturn(true);
        $stub->expects($this->once())->method(
            'diyContentFormatValidate'
        )->with($diyContent, $style)->willReturn(true);

        $result = $stub->diyContent($diyContent, $style);
        $this->assertTrue($result);
    }

    //diyContentTypeFormatValidate
    /**
     * @dataProvider additionProviderDiyContentTypeFormatValidate
     */
    public function testDiyContentTypeFormatValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentTypeFormatValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentTypeFormatValidate()
    {
        return array(
            array('', false),
            array(array(), false),
            array(array(9999), true)
        );
    }

    public function testDiyContentFormatValidateFalse()
    {
        $diyContent = $style = array('diyContent');

        $result = $this->stub->diyContentFormatValidatePublic($diyContent, $style);
        $this->assertFalse($result);
    }

    public function testDiyContentFormatValidateStyleOne()
    {
        $stub = $this->getMockBuilder(HelpPageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentStyleOneFormatValidate'
                            ])->getMock();

        $diyContent = array('diyContent');
        $style = HelpPageConfig::STYLE['STYLE_ONE'];

        $stub->expects($this->once())->method('diyContentStyleOneFormatValidate')->with($diyContent)->willReturn(true);

        $result = $stub->diyContentFormatValidatePublic($diyContent, $style);
        $this->assertTrue($result);
    }

    public function testDiyContentFormatValidateStyleTwo()
    {
        $stub = $this->getMockBuilder(HelpPageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentStyleTwoFormatValidate'
                            ])->getMock();

        $diyContent = array('diyContent');
        $style = HelpPageConfig::STYLE['STYLE_TWO'];

        $stub->expects($this->once())->method('diyContentStyleTwoFormatValidate')->with($diyContent)->willReturn(true);

        $result = $stub->diyContentFormatValidatePublic($diyContent, $style);
        $this->assertTrue($result);
    }

    public function testDiyContentFormatValidateStyleThree()
    {
        $stub = $this->getMockBuilder(HelpPageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentStyleThreeFormatValidate'
                            ])->getMock();

        $diyContent = array('diyContent');
        $style = HelpPageConfig::STYLE['STYLE_THREE'];

        $stub->expects($this->once())->method(
            'diyContentStyleThreeFormatValidate'
        )->with($diyContent)->willReturn(true);

        $result = $stub->diyContentFormatValidatePublic($diyContent, $style);
        $this->assertTrue($result);
    }

    public function testDiyContentStyleOneFormatValidate()
    {
        $stub = $this->getMockBuilder(HelpPageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentStyleOneCountFormatValidate',
                               'diyContentStyleOneContentFormatValidate'
                            ])->getMock();

        $diyContent = array('diyContent');

        $stub->expects($this->once())->method(
            'diyContentStyleOneCountFormatValidate'
        )->with($diyContent)->willReturn(true);

        $stub->expects($this->once())->method(
            'diyContentStyleOneContentFormatValidate'
        )->with($diyContent)->willReturn(true);

        $result = $stub->diyContentStyleOneFormatValidatePublic($diyContent);
        $this->assertTrue($result);
    }

    //diyContentStyleOneCountFormatValidate
    /**
     * @dataProvider additionProviderDiyContentStyleOneCountFormatValidate
     */
    public function testDiyContentStyleOneCountFormatValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentStyleOneCountFormatValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentStyleOneCountFormatValidate()
    {
        return array(
            array(array_fill(0, HelpPageConfigWidgetRule::DIY_CONTENT_STYLE_ONE_MAX_COUNT+1, 2), false),
            array(array_fill(0, HelpPageConfigWidgetRule::DIY_CONTENT_STYLE_ONE_MAX_COUNT-1, 2), true)
        );
    }

    //diyContentStyleOneContentFormatValidate
    /**
     * @dataProvider additionProviderDiyContentStyleOneContentFormatValidate
     */
    public function testDiyContentStyleOneContentFormatValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentStyleOneContentFormatValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentStyleOneContentFormatValidate()
    {
        return array(
            array(array('a'), false),
            array(array(
                array('name' => 'name')
            ), false),
            array(array(
                array('type' => 'name', 'value' => 'value')
            ), false),
            array(array(
                array('type' => 'picture', 'value' => '')
            ), false),
            array(array(
                array('type' => 'picture', 'value' => 'value')
            ), true)
        );
    }

    public function testDiyContentStyleTwoFormatValidate()
    {
        $stub = $this->getMockBuilder(HelpPageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentStyleTwoCountFormatValidate',
                               'diyContentStyleTwoContentFormatValidate'
                            ])->getMock();

        $diyContent = array('diyContent');

        $stub->expects($this->once())->method(
            'diyContentStyleTwoCountFormatValidate'
        )->with($diyContent)->willReturn(true);

        $stub->expects($this->once())->method(
            'diyContentStyleTwoContentFormatValidate'
        )->with($diyContent)->willReturn(true);

        $result = $stub->diyContentStyleTwoFormatValidatePublic($diyContent);
        $this->assertTrue($result);
    }

    //diyContentStyleTwoCountFormatValidate
    /**
     * @dataProvider additionProviderDiyContentStyleTwoCountFormatValidate
     */
    public function testDiyContentStyleTwoCountFormatValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentStyleTwoCountFormatValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentStyleTwoCountFormatValidate()
    {
        return array(
            array(array_fill(0, HelpPageConfigWidgetRule::DIY_CONTENT_STYLE_TWO_MAX_COUNT+1, 2), false),
            array(array_fill(0, HelpPageConfigWidgetRule::DIY_CONTENT_STYLE_TWO_MAX_COUNT-1, 2), true)
        );
    }

    //diyContentStyleTwoContentFormatValidate
    /**
     * @dataProvider additionProviderDiyContentStyleTwoContentFormatValidate
     */
    public function testDiyContentStyleTwoContentFormatValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentStyleTwoContentFormatValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentStyleTwoContentFormatValidate()
    {
        return array(
            array(array('a'), false),
            array(array(
                array('name' => 'name')
            ), false),
            array(array(
                array('name' => '', 'status' => 'status', 'items' => 'items')
            ), false),
            array(array(
                array('name' => 'name', 'status' => 'status', 'items' => 'items')
            ), false),
            array(array(
                array('name' => '', 'status' => 0, 'items' => 'items')
            ), false),
            array(array(
                array('name' => '', 'status' => 0, 'items' => array('items'))
            ), false),
            array(array(
                array('name' => '', 'status' => 0,
                'items' => array_fill(0, HelpPageConfigWidgetRule::DIY_CONTENT_STYLE_TWO_ITEMS_MAX_COUNT+1, 2))
            ), false),
            array(array(
                array('name' => '', 'status' => 0, 'items' => array(array('name' => '', 'link' => '')))
            ), false),
            array(array(
                array('name' => '', 'status' => 0, 'items' => array(array('name' => '', 'link' => '', 'status' => 0)))
            ), false),
            array(array(
                array('name' => '', 'status' => 0,
                    'items' => array(array('name' => 'name', 'link' => '', 'status' => 'status'))
                )
            ), false),
            array(array(
                array('name' => '', 'status' => 0,
                    'items' => array(array('name' => 'name', 'link' => '', 'status' => 0))
                )
            ), false),
            array(array(
                array('name' => 'name', 'status' => 0,
                    'items' => array(array('name' => 'name', 'link' => 'link', 'status' => 0))
                )
            ), true),
        );
    }

    //diyContentStyleTwoContentItemsFormatValidate
    /**
     * @dataProvider additionProviderDiyContentStyleTwoContentItemsFormatValidate
     */
    public function testDiyContentStyleTwoContentItemsFormatValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentStyleTwoContentItemsFormatValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentStyleTwoContentItemsFormatValidate()
    {
        return array(
            array(array_fill(0, HelpPageConfigWidgetRule::DIY_CONTENT_STYLE_TWO_ITEMS_MAX_COUNT+1, 2), false),
            array(array(array('name' => '')), false),
            array(array(array('name' => '', 'status' => 'status', 'link' => 'link')), false),
            array(array(array('name' => 'name', 'status' => 'status', 'link' => 'link')), false),
            array(array(array('name' => 'name', 'status' => 0, 'link' => '')), false),
            array(array(array('name' => 'name', 'status' => 0, 'link' => 'link')), true)
        );
    }

    public function testDiyContentStyleThreeFormatValidate()
    {
        $stub = $this->getMockBuilder(HelpPageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentStyleThreeCountFormatValidate',
                               'diyContentStyleThreeContentFormatValidate'
                            ])->getMock();

        $diyContent = array('diyContent');

        $stub->expects($this->once())->method(
            'diyContentStyleThreeCountFormatValidate'
        )->with($diyContent)->willReturn(true);

        $stub->expects($this->once())->method(
            'diyContentStyleThreeContentFormatValidate'
        )->with($diyContent)->willReturn(true);

        $result = $stub->diyContentStyleThreeFormatValidatePublic($diyContent);
        $this->assertTrue($result);
    }

    //diyContentStyleThreeCountFormatValidate
    /**
     * @dataProvider additionProviderDiyContentStyleThreeCountFormatValidate
     */
    public function testDiyContentStyleThreeCountFormatValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentStyleThreeCountFormatValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentStyleThreeCountFormatValidate()
    {
        return array(
            array(array_fill(0, HelpPageConfigWidgetRule::DIY_CONTENT_STYLE_THREE_MAX_COUNT+1, 2), false),
            array(array_fill(0, HelpPageConfigWidgetRule::DIY_CONTENT_STYLE_THREE_MAX_COUNT-1, 2), true)
        );
    }

    //diyContentStyleThreeContentFormatValidate
    /**
     * @dataProvider additionProviderDiyContentStyleThreeContentFormatValidate
     */
    public function testDiyContentStyleThreeContentFormatValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentStyleThreeContentFormatValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentStyleThreeContentFormatValidate()
    {
        return array(
            array(array('a'), false),
            array(array(array('name' => 'name')), false),
            array(array(array('name' => '', 'link' => 'link', 'status' => 'status')), false),
            array(array(array('name' => 'name', 'link' => 'link', 'status' => 'status')), false),
            array(array(array('name' => 'name', 'link' => '', 'status' => 0)), false),
            array(array(array('name' => 'name', 'link' => 'link', 'status' => 0)), true)
        );
    }

    //link
    /**
     * @dataProvider additionProviderLink
     */
    public function testLink($parameter, $expected)
    {
        $result = $this->stub->linkPublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderLink()
    {
        $faker = \Faker\Factory::create('zh_CN');

        return array(
            array('', false),
            array($faker->randomNumber(), false),
            array($this->randomChar(HelpPageConfigWidgetRule::LINK_MIN_LENGTH), true),
            array($this->randomChar(HelpPageConfigWidgetRule::LINK_MIN_LENGTH-1), false),
            array($this->randomChar(HelpPageConfigWidgetRule::LINK_MAX_LENGTH), true),
            array($this->randomChar(HelpPageConfigWidgetRule::LINK_MAX_LENGTH+1), false)
        );
    }
}
