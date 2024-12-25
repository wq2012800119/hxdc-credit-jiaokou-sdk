<?php
namespace Sdk\WebsiteConfig\HomePageConfig\WidgetRule;

use Marmot\Core;
use PHPUnit\Framework\TestCase;
use Sdk\Common\WidgetRule\CommonWidgetRule;
use Sdk\Common\Utils\Traits\CharacterGeneratorTrait;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class HomePageConfigWidgetRuleTest extends TestCase
{
    use CharacterGeneratorTrait;

    private $stub;

    protected function setUp(): void
    {
        $this->stub = new HomePageConfigWidgetRuleMock();
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

    public function testDiyContent()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRule::class)
                           ->setMethods([
                               'diyContentTypeFormatValidate',
                               'diyContentFormatRequiredKeysValidate',
                               'diyContentFormatValidate'
                            ])->getMock();

        $diyContent= array('diyContent');

        $stub->expects($this->once())->method('diyContentTypeFormatValidate')->with($diyContent)->willReturn(true);
        $stub->expects($this->once())->method(
            'diyContentFormatRequiredKeysValidate'
        )->with($diyContent)->willReturn(true);
        $stub->expects($this->once())->method('diyContentFormatValidate')->with($diyContent)->willReturn(true);
        
        $result = $stub->diyContent($diyContent);
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
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentTypeFormatValidate()
    {
        return array(
            array('', false),
            array(array(), false),
            array(array(10000), true)
        );
    }

    //diyContentFormatRequiredKeysValidate
    /**
     * @dataProvider additionProviderDiyContentFormatRequiredKeysValidate
     */
    public function testDiyContentFormatRequiredKeysValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentFormatRequiredKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentFormatRequiredKeysValidate()
    {
        $requiredKeysName = HomePageConfigWidgetRule::DIY_CONTENT_REQUIRED_KEYS_NAME;
        $data = array();

        foreach ($requiredKeysName as $name) {
            $data[$name] = $name;
        }

        return array(
            array(array('test'=>'test'), false),
            array($data, true)
        );
    }

    //diyContentFormatValidate
    /**
     * @dataProvider additionProviderDiyContentFormatValidate
     */
    public function testDiyContentFormatValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentFormatValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentFormatValidate()
    {
        return array(
            array(array('test'), false),
            array(array('headerBackGround' => array('name' => 'name', 'address'=>'address')), false),
            array(array('headerBackGround' => array('name' => 'name', 'address'=>'address.jpg')), true),
        );
    }

    //headerBarLeft
    public function testHeaderBarLeftValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::HEADER_BAR_LEFT_MAX_COUNT+1, 2);

        $result = $this->stub->headerBarLeftValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testHeaderBarLeftValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'headerBarLeftKeysValidate'
                            ])->getMock();
                            
        $content = array(array('name'));

        $stub->expects($this->once())->method('headerBarLeftKeysValidate')->willReturn(false);

        $result = $stub->headerBarLeftValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testHeaderBarLeftValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'headerBarLeftKeysValidate',
                               'diyContentNameValidate',
                               'diyContentTypeValidate',
                               'diyContentLinkValidate',
                               'diyContentStatusValidate'
                            ])->getMock();
                            
        $content = array(
            array('name' => 'name', 'link' => 'link', 'type' => 1, 'status' => 0)
        );

        $stub->expects($this->once())->method('headerBarLeftKeysValidate')->willReturn(true);
        $stub->expects($this->once())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->once())->method('diyContentTypeValidate')->willReturn(true);
        $stub->expects($this->once())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->once())->method('diyContentStatusValidate')->willReturn(true);

        $result = $stub->headerBarLeftValidatePublic($content);

        $this->assertTrue($result);
    }

    //headerBarLeftKeysValidate
    /**
     * @dataProvider additionProviderHeaderBarLeftKeysValidate
     */
    public function testHeaderBarLeftKeysValidate($parameter, $expected)
    {
        $result = $this->stub->headerBarLeftKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderHeaderBarLeftKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('name' => 'name', 'type'=>1, 'link' => 'link', 'status' => 0), true),
        );
    }

    //headerBarRight
    public function testHeaderBarRightValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::HEADER_BAR_RIGHT_MAX_COUNT+1, 2);

        $result = $this->stub->headerBarRightValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testHeaderBarRightValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'headerBarRightKeysValidate'
                            ])->getMock();
                            
        $content = array(array('name'));

        $stub->expects($this->once())->method('headerBarRightKeysValidate')->willReturn(false);

        $result = $stub->headerBarRightValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testHeaderBarRightValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'headerBarRightKeysValidate',
                               'diyContentNameValidate',
                               'diyContentTypeValidate',
                               'diyContentLinkValidate',
                               'diyContentStatusValidate',
                               'diyContentCodeTypeValidate'
                            ])->getMock();
                            
        $content = array(
            array('name' => 'name', 'link' => 'link', 'type' => 1, 'status' => 0, 'codeType' => 1)
        );

        $stub->expects($this->once())->method('headerBarRightKeysValidate')->willReturn(true);
        $stub->expects($this->once())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->once())->method('diyContentTypeValidate')->willReturn(true);
        $stub->expects($this->once())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->once())->method('diyContentStatusValidate')->willReturn(true);
        $stub->expects($this->once())->method('diyContentCodeTypeValidate')->willReturn(true);

        $result = $stub->headerBarRightValidatePublic($content);

        $this->assertTrue($result);
    }

    //headerBarRightKeysValidate
    /**
     * @dataProvider additionProviderHeaderBarRightKeysValidate
     */
    public function testHeaderBarRightKeysValidate($parameter, $expected)
    {
        $result = $this->stub->headerBarRightKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderHeaderBarRightKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('name' => 'name', 'type'=>1, 'link' => 'link', 'status' => 0, 'codeType' => 1), true)
        );
    }

    //logoValidate
    /**
     * @dataProvider additionProviderLogoValidate
     */
    public function testLogoValidate($parameter, $expected)
    {
        $result = $this->stub->logoValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderLogoValidate()
    {
        return array(
            array(array('test'), false),
            array(array('displayPosition' => 'name', 'address'=>'address'), false),
            array(array('displayPosition' => 'name', 'picture'=>array('name')), false),
            array(array('displayPosition' => 0, 'picture'=>array('name')), false),
            array(array('displayPosition' => 0, 'picture'=>array('name' => 'name', 'address' => '1.jpg')), true)
        );
    }

    //themeValidate
    /**
     * @dataProvider additionProviderThemeValidate
     */
    public function testThemeValidate($parameter, $expected)
    {
        $result = $this->stub->themeValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderThemeValidate()
    {
        return array(
            array(array('test'), false),
            array(array('color' => 'name', 'address'=>'address'), false),
            array(array('color' => 'name', 'picture'=>array('name')), false),
            array(array('color' => 'name', 'picture'=>array('name' => 'name', 'address' => '1.jpg')), true)
        );
    }

    //headerBackGroundValidate
    /**
     * @dataProvider additionProviderHeaderBackGroundValidate
     */
    public function testHeaderBackGroundValidate($parameter, $expected)
    {
        $result = $this->stub->headerBackGroundValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderHeaderBackGroundValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address.png'), true),
            array(array('name' => 'name', 'type'=>1, 'link' => 'link'), false)
        );
    }

    //headerSearch
    public function testHeaderSearchValidateContentKeysFalse()
    {
        $content = array('test');

        $result = $this->stub->headerSearchValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testHeaderSearchValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'headerSearchKeysValidate'
                            ])->getMock();
                            
        $content = array(
            'creditInfo' => 'creditInfo',
            'unifiedIdentifier' => 'unifiedIdentifier',
            'article' => 'article'
        );

        $stub->expects($this->once())->method('headerSearchKeysValidate')->willReturn(false);

        $result = $stub->headerSearchValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testHeaderSearchValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'headerSearchKeysValidate',
                               'diyContentNameValidate',
                               'headerSearchPlaceholderValidate',
                               'diyContentStatusValidate'
                            ])->getMock();
                            
         
        $content = array(
            'creditInfo' => array('name' => 'name', 'placeholder' => 'placeholder', 'link' => 'link', 'status' => 0),
            'unifiedIdentifier' => array('name' => 'name', 'placeholder' => 'value', 'link' => 'link', 'status' => 0),
            'article' => array('name' => 'name', 'placeholder' => 'placeholder', 'link' => 'link', 'status' => 0),
        );

        $stub->expects($this->any())->method('headerSearchKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('headerSearchPlaceholderValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);

        $result = $stub->headerSearchValidatePublic($content);

        $this->assertTrue($result);
    }

    //headerSearchKeysValidate
    /**
     * @dataProvider additionProviderHeaderSearchKeysValidate
     */
    public function testHeaderSearchKeysValidate($parameter, $expected)
    {
        $result = $this->stub->headerSearchKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderHeaderSearchKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('name' => 'name', 'placeholder'=>'placeholder', 'link' => 'link', 'status' => 0), true)
        );
    }

    //headerSearchPlaceholderValidate
    /**
     * @dataProvider additionProviderHeaderSearchPlaceholderValidate
     */
    public function testHeaderSearchPlaceholderValidate($parameter, $expected)
    {
        $result = $this->stub->headerSearchPlaceholderValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderHeaderSearchPlaceholderValidate()
    {
        return array(
            array(array('test'), false),
            array('', false),
            array('placeholder', true)
        );
    }

    //mainNav
    public function testMainNavValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::MAIN_NAV_MAX_COUNT+1, 2);

        $result = $this->stub->mainNavValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testMainNavValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'mainNavKeysValidate'
                            ])->getMock();
                            
        $content = array('name');

        $stub->expects($this->once())->method('mainNavKeysValidate')->willReturn(false);

        $result = $stub->mainNavValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testMainNavValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'mainNavKeysValidate',
                               'diyContentNameValidate',
                               'diyContentLinkValidate',
                               'mainNavTypeValidate',
                               'diyContentIntValidate',
                               'diyContentStatusValidate'
                            ])->getMock();
                            
         
        $content = array(
            array('name' => 'name', 'link' => 'link', 'navType' => 1, 'articleCategory' => 0, 'status' => 0)
        );

        $stub->expects($this->any())->method('mainNavKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('mainNavTypeValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentIntValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);

        $result = $stub->mainNavValidatePublic($content);

        $this->assertTrue($result);
    }

    //mainNavKeysValidate
    /**
     * @dataProvider additionProviderMainNavKeysValidate
     */
    public function testMainNavKeysValidate($parameter, $expected)
    {
        $result = $this->stub->mainNavKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderMainNavKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('name' => 'name', 'navType'=>1, 'link' => 'link', 'status' => 0, 'articleCategory' => 0), true)
        );
    }

    //mainNavTypeValidate
    /**
     * @dataProvider additionProviderMainNavTypeValidate
     */
    public function testMainNavTypeValidate($parameter, $expected)
    {
        $result = $this->stub->mainNavTypeValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderMainNavTypeValidate()
    {
        return array(
            array(array('test'), false),
            array(12222, false),
            array(HomePageConfigWidgetRule::MAIN_NAV_TYPE['ARTICLE'], true)
        );
    }

    //topFloatingWindow
    public function testTopFloatingWindowValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'topFloatingWindowKeysValidate'
                            ])->getMock();
                            
        $content = array('name');

        $stub->expects($this->once())->method('topFloatingWindowKeysValidate')->willReturn(false);

        $result = $stub->topFloatingWindowValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testTopFloatingWindowValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'topFloatingWindowKeysValidate',
                               'topFloatingWindowDisplayStyleValidate',
                               'topFloatingWindowSlidesValidate'
                            ])->getMock();
                            
         
        $content = array('displayStyle' =>0, 'slides' => array('slides'));

        $stub->expects($this->any())->method('topFloatingWindowKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('topFloatingWindowDisplayStyleValidate')->willReturn(true);
        $stub->expects($this->any())->method('topFloatingWindowSlidesValidate')->willReturn(true);

        $result = $stub->topFloatingWindowValidatePublic($content);

        $this->assertTrue($result);
    }

    //topFloatingWindowKeysValidate
    /**
     * @dataProvider additionProviderTopFloatingWindowKeysValidate
     */
    public function testTopFloatingWindowKeysValidate($parameter, $expected)
    {
        $result = $this->stub->topFloatingWindowKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderTopFloatingWindowKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('displayStyle' => 0, 'slides' => array('slides')), true)
        );
    }

    //topFloatingWindowDisplayStyleValidate
    /**
     * @dataProvider additionProviderTopFloatingWindowDisplayStyleValidate
     */
    public function testTopFloatingWindowDisplayStyleValidate($parameter, $expected)
    {
        $result = $this->stub->topFloatingWindowDisplayStyleValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderTopFloatingWindowDisplayStyleValidate()
    {
        return array(
            array(array('displayStyle'=> 'displayStyle'), false),
            array(array('displayStyle' => HomePageConfigWidgetRule::TOP_FLOATING_WINDOW_DISPLAY_STYLE['SLIDES']), true)
        );
    }

    //topFloatingWindowSlidesValidate
    public function testTopFloatingWindowSlidesValidateEmpty()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'topFloatingWindowSlidesEmptyValidate'
                            ])->getMock();
                            
         
        $content = array(
            'displayStyle' => HomePageConfigWidgetRule::TOP_FLOATING_WINDOW_DISPLAY_STYLE['HEADLINE_NEWS'],
            'slides' => array('slides')
        );

        $stub->expects($this->any())->method('topFloatingWindowSlidesEmptyValidate')->willReturn(true);

        $result = $stub->topFloatingWindowSlidesValidatePublic($content);

        $this->assertTrue($result);
    }

    public function testTopFloatingWindowSlidesValidateNotEmpty()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'topFloatingWindowSlidesNotEmptyValidate'
                            ])->getMock();
                            
         
        $content = array(
            'displayStyle' => HomePageConfigWidgetRule::TOP_FLOATING_WINDOW_DISPLAY_STYLE['SLIDES'],
            'slides' => array('slides')
        );

        $stub->expects($this->any())->method('topFloatingWindowSlidesNotEmptyValidate')->willReturn(true);

        $result = $stub->topFloatingWindowSlidesValidatePublic($content);

        $this->assertTrue($result);
    }

    //topFloatingWindowSlidesEmptyValidate
    /**
     * @dataProvider additionProviderTopFloatingWindowSlidesEmptyValidate
     */
    public function testTopFloatingWindowSlidesEmptyValidate($parameter, $expected)
    {
        $result = $this->stub->topFloatingWindowSlidesEmptyValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderTopFloatingWindowSlidesEmptyValidate()
    {
        return array(
            array(array(), true),
            array(array('slides'), false)
        );
    }

    //topFloatingWindowSlidesNotEmptyValidate
    public function testTopFloatingWindowSlidesNotEmptyValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::TOP_FLOATING_WINDOW_SLIDES_MAX_COUNT+1, 2);

        $result = $this->stub->topFloatingWindowSlidesNotEmptyValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testTopFloatingWindowSlidesNotEmptyValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'topFloatingWindowSlidesKeysValidate'
                            ])->getMock();
                            
        $content = array('name');

        $stub->expects($this->once())->method('topFloatingWindowSlidesKeysValidate')->willReturn(false);

        $result = $stub->topFloatingWindowSlidesNotEmptyValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testTopFloatingWindowSlidesNotEmptyValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'topFloatingWindowSlidesKeysValidate',
                               'diyContentNameValidate',
                               'diyContentLinkValidate',
                               'diyContentPictureValidate',
                               'diyContentStatusValidate'
                            ])->getMock();
                            
         
        $content = array(
            array('name' => 'name', 'link' => 'link', 'picture' => array('picture'), 'status' => 0)
        );

        $stub->expects($this->any())->method('topFloatingWindowSlidesKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentPictureValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);

        $result = $stub->topFloatingWindowSlidesNotEmptyValidatePublic($content);

        $this->assertTrue($result);
    }

    //topFloatingWindowSlidesKeysValidate
    /**
     * @dataProvider additionProviderTopFloatingWindowSlidesKeysValidate
     */
    public function testTopFloatingWindowSlidesKeysValidate($parameter, $expected)
    {
        $result = $this->stub->topFloatingWindowSlidesKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderTopFloatingWindowSlidesKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name'=>'name', 'address'=>'address'), false),
            array(array('name'=>'name', 'picture'=>array('picture'), 'link'=>'link', 'status'=>0), true)
        );
    }

    //searchNav
    public function testSearchNavValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::SEARCH_NAV_MAX_COUNT+1, 2);

        $result = $this->stub->searchNavValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testSearchNavValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'searchNavKeysValidate'
                            ])->getMock();
                            
        $content = array('name');

        $stub->expects($this->once())->method('searchNavKeysValidate')->willReturn(false);

        $result = $stub->searchNavValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testSearchNavValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'searchNavKeysValidate',
                               'diyContentNameValidate',
                               'diyContentLinkValidate',
                               'diyContentPictureValidate',
                               'diyContentStatusValidate'
                            ])->getMock();
                            
         
        $content = array(
            array('name' => 'name', 'link' => 'link', 'picture' => array('name') ,'status' => 0)
        );

        $stub->expects($this->any())->method('searchNavKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentPictureValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);

        $result = $stub->searchNavValidatePublic($content);

        $this->assertTrue($result);
    }

    //searchNavKeysValidate
    /**
     * @dataProvider additionProviderSearchNavKeysValidate
     */
    public function testSearchNavKeysValidate($parameter, $expected)
    {
        $result = $this->stub->searchNavKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderSearchNavKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('name' => 'name', 'picture'=> array('picture'), 'link' => 'link', 'status' => 0), true)
        );
    }

    //articleContent
    public function testArticleContentValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::ARTICLE_CONTENT_COUNT+1, 2);

        $result = $this->stub->articleContentValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testArticleContentValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'articleContentKeysValidate'
                            ])->getMock();
                            
        $content = array_fill(0, HomePageConfigWidgetRule::ARTICLE_CONTENT_COUNT, 2);

        $stub->expects($this->once())->method('articleContentKeysValidate')->willReturn(false);

        $result = $stub->articleContentValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testArticleContentValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'articleContentKeysValidate',
                               'diyContentIntValidate'
                            ])->getMock();
                            
        $content = array_fill(
            0,
            HomePageConfigWidgetRule::ARTICLE_CONTENT_COUNT,
            array('category' => 1, 'count' => 2)
        );

        $stub->expects($this->any())->method('articleContentKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentIntValidate')->willReturn(true);

        $result = $stub->articleContentValidatePublic($content);

        $this->assertTrue($result);
    }

    //articleContentKeysValidate
    /**
     * @dataProvider additionProviderArticleContentKeysValidate
     */
    public function testArticleContentKeysValidate($parameter, $expected)
    {
        $result = $this->stub->articleContentKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderArticleContentKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('category' => 1, 'count' => 1), true)
        );
    }

    //topicColumn
    public function testTopicColumnValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::TOPIC_COLUMN_COUNT+1, 2);

        $result = $this->stub->topicColumnValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testTopicColumnValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'topicColumnKeysValidate'
                            ])->getMock();
                            
        $content = array_fill(0, HomePageConfigWidgetRule::TOPIC_COLUMN_COUNT, 2);

        $stub->expects($this->once())->method('topicColumnKeysValidate')->willReturn(false);

        $result = $stub->topicColumnValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testTopicColumnValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'topicColumnKeysValidate',
                               'diyContentNameValidate',
                               'diyContentLinkValidate',
                               'diyContentPictureValidate'
                            ])->getMock();
                            
        $content = array_fill(
            0,
            HomePageConfigWidgetRule::TOPIC_COLUMN_COUNT,
            array('name' => 'name', 'link' => 'link', 'picture' => array('picture'))
        );

        $stub->expects($this->any())->method('topicColumnKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentPictureValidate')->willReturn(true);

        $result = $stub->topicColumnValidatePublic($content);

        $this->assertTrue($result);
    }

    //topicColumnKeysValidate
    /**
     * @dataProvider additionProviderTopicColumnKeysValidate
     */
    public function testTopicColumnKeysValidate($parameter, $expected)
    {
        $result = $this->stub->topicColumnKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderTopicColumnKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('name' => 'name', 'link' => 'link', 'picture' => array('picture')), true)
        );
    }

    //relevantSlides
    public function testRelevantSlidesValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::RELEVANT_SLIDES_MAX_COUNT+1, 2);

        $result = $this->stub->relevantSlidesValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testRelevantSlidesValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'relevantSlidesKeysValidate'
                            ])->getMock();
                            
        $content = array('name');

        $stub->expects($this->once())->method('relevantSlidesKeysValidate')->willReturn(false);

        $result = $stub->relevantSlidesValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testRelevantSlidesValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'relevantSlidesKeysValidate',
                               'diyContentNameValidate',
                               'diyContentLinkValidate',
                               'diyContentPictureValidate',
                               'diyContentStatusValidate'
                            ])->getMock();
                            
         
        $content = array(
            array('name' => 'name', 'link' => 'link', 'picture' => array('name') ,'status' => 0)
        );

        $stub->expects($this->any())->method('relevantSlidesKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentPictureValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);

        $result = $stub->relevantSlidesValidatePublic($content);

        $this->assertTrue($result);
    }

    //relevantSlidesKeysValidate
    /**
     * @dataProvider additionProviderRelevantSlidesKeysValidate
     */
    public function testRelevantSlidesKeysValidate($parameter, $expected)
    {
        $result = $this->stub->relevantSlidesKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderRelevantSlidesKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('name' => 'name', 'picture'=> array('picture'), 'link' => 'link', 'status' => 0), true)
        );
    }

    //relatedLinks
    public function testRelatedLinksValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::RELATED_LINKS_MAX_COUNT+1, 2);

        $result = $this->stub->relatedLinksValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testRelatedLinksValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'relatedLinksKeysValidate'
                            ])->getMock();
                            
        $content = array('name');

        $stub->expects($this->once())->method('relatedLinksKeysValidate')->willReturn(false);

        $result = $stub->relatedLinksValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testRelatedLinksValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'relatedLinksKeysValidate',
                               'diyContentNameValidate',
                               'relatedLinksItemsValidate',
                               'diyContentStatusValidate'
                            ])->getMock();
                            
         
        $content = array(
            array('name' => 'name', 'items' => array('items') ,'status' => 0)
        );

        $stub->expects($this->any())->method('relatedLinksKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('relatedLinksItemsValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);

        $result = $stub->relatedLinksValidatePublic($content);

        $this->assertTrue($result);
    }

    //relatedLinksKeysValidate
    /**
     * @dataProvider additionProviderRelatedLinksKeysValidate
     */
    public function testRelatedLinksKeysValidate($parameter, $expected)
    {
        $result = $this->stub->relatedLinksKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderRelatedLinksKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('name' => 'name', 'items'=> array('items'), 'status' => 0), true)
        );
    }

    //relatedLinksItemsValidate
    public function testRelatedLinksItemsValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::RELATED_LINKS_ITEMS_MAX_COUNT+1, 2);

        $result = $this->stub->relatedLinksItemsValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testRelatedLinksItemsValidateFalse()
    {
        $content = array('name');

        $result = $this->stub->relatedLinksItemsValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testRelatedLinksItemsValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentNameValidate',
                               'diyContentLinkValidate',
                               'diyContentStatusValidate'
                            ])->getMock();
                            
         
        $content = array(
            array('name' => 'name', 'link' => 'link' ,'status' => 0)
        );

        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);

        $result = $stub->relatedLinksItemsValidatePublic($content);

        $this->assertTrue($result);
    }

    //statisticsValidate
    public function testStatisticsValidateKeysFalse()
    {
        $content = array('name');

        $result = $this->stub->statisticsValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testStatisticsValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentStatusValidate'
                            ])->getMock();
                            
         
        $content = array('sgsStatus' => 0 ,'hhmdStatus' => 0, 'xycnStatus' => 0);

        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(false);

        $result = $stub->statisticsValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testStatisticsValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentStatusValidate',
                            ])->getMock();
                            
        $content = array('sgsStatus' => 0 ,'hhmdStatus' => 0, 'xycnStatus' => 0);

        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);

        $result = $stub->statisticsValidatePublic($content);

        $this->assertTrue($result);
    }
    //partyAndGovernmentOrgans
    public function testPartyAndGovernmentOrgansValidateKeysFalse()
    {
        $content = array('name');

        $result = $this->stub->partyAndGovernmentOrgansValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testPartyAndGovernmentOrgansValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentLinkValidate'
                            ])->getMock();
                            
         
        $content = array('link' => 'link' ,'status' => 0, 'displayPosition' => 0);

        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(false);

        $result = $stub->partyAndGovernmentOrgansValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testPartyAndGovernmentOrgansValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentLinkValidate',
                               'diyContentStatusValidate',
                               'diyContentDisplayPositionValidate'
                            ])->getMock();
                            
         
        $content = array('link' => 'link' ,'status' => 0, 'displayPosition' => 0);

        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentDisplayPositionValidate')->willReturn(true);

        $result = $stub->partyAndGovernmentOrgansValidatePublic($content);

        $this->assertTrue($result);
    }

    //governmentWebsiteErrorCorrection
    public function testGovernmentWebsiteErrorCorrectionValidateKeysFalse()
    {
        $content = array('name');

        $result = $this->stub->governmentWebsiteErrorCorrectionValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testGovernmentWebsiteErrorCorrectionValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentLinkValidate'
                            ])->getMock();
                            
         
        $content = array('link' => 'link' ,'status' => 0, 'displayPosition' => 0);

        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(false);

        $result = $stub->governmentWebsiteErrorCorrectionValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testGovernmentWebsiteErrorCorrectionValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentLinkValidate',
                               'diyContentStatusValidate',
                               'diyContentDisplayPositionValidate'
                            ])->getMock();
                            
         
        $content = array('link' => 'link' ,'status' => 0, 'displayPosition' => 0);

        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentDisplayPositionValidate')->willReturn(true);

        $result = $stub->governmentWebsiteErrorCorrectionValidatePublic($content);

        $this->assertTrue($result);
    }

    //footerOne
    public function testFooterOneValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::FOOTER_ONE_MAX_COUNT+1, 2);

        $result = $this->stub->footerOneValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testFooterOneValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'footerOneKeysValidate'
                            ])->getMock();
                            
        $content = array('name');

        $stub->expects($this->once())->method('footerOneKeysValidate')->willReturn(false);

        $result = $stub->footerOneValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testFooterOneValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'footerOneKeysValidate',
                               'diyContentNameValidate',
                               'diyContentLinkValidate',
                               'diyContentStatusValidate'
                            ])->getMock();
                            
         
        $content = array(
            array('name' => 'name', 'link' => 'link','status' => 0)
        );

        $stub->expects($this->any())->method('footerOneKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);

        $result = $stub->footerOneValidatePublic($content);

        $this->assertTrue($result);
    }

    //footerOneKeysValidate
    /**
     * @dataProvider additionProviderFooterOneKeysValidate
     */
    public function testFooterOneKeysValidate($parameter, $expected)
    {
        $result = $this->stub->footerOneKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderFooterOneKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('name' => 'name', 'link' => 'link', 'status' => 0), true)
        );
    }

    //footerTwo
    public function testFooterTwoValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::FOOTER_TWO_MAX_COUNT+1, 2);

        $result = $this->stub->footerTwoValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testFooterTwoValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'footerTwoKeysValidate'
                            ])->getMock();
                            
        $content = array('name');

        $stub->expects($this->once())->method('footerTwoKeysValidate')->willReturn(false);

        $result = $stub->footerTwoValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testFooterTwoValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'footerTwoKeysValidate',
                               'diyContentNameValidate',
                               'diyContentValueValidate',
                               'diyContentStatusValidate'
                            ])->getMock();
                            
         
        $content = array(
            array('name' => 'name', 'value' => 'value','status' => 0)
        );

        $stub->expects($this->any())->method('footerTwoKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentValueValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);

        $result = $stub->footerTwoValidatePublic($content);

        $this->assertTrue($result);
    }

    //footerTwoKeysValidate
    /**
     * @dataProvider additionProviderFooterTwoKeysValidate
     */
    public function testFooterTwoKeysValidate($parameter, $expected)
    {
        $result = $this->stub->footerTwoKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderFooterTwoKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('name' => 'name', 'value' => 'value', 'status' => 0), true)
        );
    }

    //footerThree
    public function testFooterThreeValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::FOOTER_THREE_MAX_COUNT+1, 2);

        $result = $this->stub->footerThreeValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testFooterThreeValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'footerThreeKeysValidate'
                            ])->getMock();
                            
        $content = array(array('picture' => array('picture')));

        $stub->expects($this->once())->method('footerThreeKeysValidate')->willReturn(false);

        $result = $stub->footerThreeValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testFooterThreeValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'footerThreeKeysValidate',
                               'diyContentNameValidate',
                               'diyContentValueValidate',
                               'diyContentStatusValidate',
                               'diyContentLinkValidate',
                               'diyContentPictureValidate'
                            ])->getMock();
                            
         
        $content = array(
            array('name' => 'name', 'value' => 'value','status' => 0, 'link' => 'link', 'picture' => array('picture'))
        );

        $stub->expects($this->any())->method('footerThreeKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentValueValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentPictureValidate')->willReturn(true);

        $result = $stub->footerThreeValidatePublic($content);

        $this->assertTrue($result);
    }

    //footerThreeKeysValidate
    /**
     * @dataProvider additionProviderFooterThreeKeysValidate
     */
    public function testFooterThreeKeysValidate($parameter, $expected)
    {
        $result = $this->stub->footerThreeKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderFooterThreeKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('name' => 'a', 'value' => 'b', 'status' => 0, 'link' => 'c', 'picture' => 'd'), true)
        );
    }

    //middlePopBox
    public function testMiddlePopBoxValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'middlePopBoxKeysValidate'
                            ])->getMock();
                            
        $content = array('link' => 'link');

        $stub->expects($this->once())->method('middlePopBoxKeysValidate')->willReturn(false);

        $result = $stub->middlePopBoxValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testMiddlePopBoxValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'middlePopBoxKeysValidate',
                               'diyContentStatusValidate',
                               'diyContentLinkValidate',
                               'diyContentPictureValidate'
                            ])->getMock();
                            
         
        $content = array('status' => 0, 'link' => 'link', 'picture' => array('picture'));

        $stub->expects($this->any())->method('middlePopBoxKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentPictureValidate')->willReturn(true);

        $result = $stub->middlePopBoxValidatePublic($content);

        $this->assertTrue($result);
    }

    //middlePopBoxKeysValidate
    /**
     * @dataProvider additionProviderMiddlePopBoxKeysValidate
     */
    public function testMiddlePopBoxKeysValidate($parameter, $expected)
    {
        $result = $this->stub->middlePopBoxKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderMiddlePopBoxKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('status' => 0, 'link' => 'link', 'picture' => 'picture'), true)
        );
    }

    //bayWindow
    public function testBayWindowValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::BAY_WINDOW_MAX_COUNT+1, 2);

        $result = $this->stub->bayWindowValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testBayWindowValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'bayWindowKeysValidate'
                            ])->getMock();
                            
        $content = array('name');

        $stub->expects($this->once())->method('bayWindowKeysValidate')->willReturn(false);

        $result = $stub->bayWindowValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testBayWindowValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'bayWindowKeysValidate',
                               'diyContentLinkValidate',
                               'diyContentPictureValidate',
                               'diyContentStatusValidate'
                            ])->getMock();
                            
         
        $content = array(
            array('link' => 'link', 'picture' => 'picture', 'status' => 0)
        );

        $stub->expects($this->any())->method('bayWindowKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentPictureValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);

        $result = $stub->bayWindowValidatePublic($content);

        $this->assertTrue($result);
    }

    //bayWindowKeysValidate
    /**
     * @dataProvider additionProviderBayWindowKeysValidate
     */
    public function testBayWindowKeysValidate($parameter, $expected)
    {
        $result = $this->stub->bayWindowKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderBayWindowKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('link' => 'link', 'picture' => 'picture', 'status' => 0), true)
        );
    }

    //rightNav
    public function testRightNavValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::RIGHT_NAV_MAX_COUNT+1, 2);

        $result = $this->stub->rightNavValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testRightNavValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'rightNavKeysValidate'
                            ])->getMock();
                            
        $content = array('name');

        $stub->expects($this->once())->method('rightNavKeysValidate')->willReturn(false);

        $result = $stub->rightNavValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testRightNavValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'rightNavKeysValidate',
                               'diyContentPictureValidate',
                               'diyContentNameValidate',
                               'diyContentTypeValidate',
                               'diyContentLinkValidate',
                               'diyContentStatusValidate',
                               'rightNavPicturesValidate',
                               'diyContentValueValidate'
                            ])->getMock();
                            
         
        $content = array(
            array(
                'icon' => 'icon',
                'name' => 'name',
                'type' => 1,
                'link' => 'link',
                'pictures' => array('pictures'),
                'status' => 0,
                'description' => 'description'
            )
        );

        $stub->expects($this->any())->method('rightNavKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentPictureValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentTypeValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);
        $stub->expects($this->any())->method('rightNavPicturesValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentValueValidate')->willReturn(true);

        $result = $stub->rightNavValidatePublic($content);

        $this->assertTrue($result);
    }

    //rightNavKeysValidate
    /**
     * @dataProvider additionProviderRightNavKeysValidate
     */
    public function testRightNavKeysValidate($parameter, $expected)
    {
        $result = $this->stub->rightNavKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderRightNavKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array(
                'icon' => 'icon',
                'name' => 'name',
                'type' => 1,
                'link' => 'link',
                'pictures' => array('pictures'),
                'status' => 0,
                'description' => 'description'
            ), true)
        );
    }

    //leftFloatingWindow
    public function testLeftFloatingWindowValidateCountFalse()
    {
        $content = array_fill(0, HomePageConfigWidgetRule::LEFT_FLOATING_WINDOW_MAX_COUNT+1, 2);

        $result = $this->stub->leftFloatingWindowValidatePublic($content);

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testLeftFloatingWindowValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'leftFloatingWindowKeysValidate'
                            ])->getMock();
                            
        $content = array('name');

        $stub->expects($this->once())->method('leftFloatingWindowKeysValidate')->willReturn(false);

        $result = $stub->leftFloatingWindowValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testLeftFloatingWindowValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'leftFloatingWindowKeysValidate',
                               'diyContentNameValidate',
                               'diyContentLinkValidate',
                               'diyContentStatusValidate',
                               'diyContentPictureValidate'
                            ])->getMock();
                            
         
        $content = array(
            array(
                'name' => 'name',
                'link' => 'link',
                'picture' => array('picture'),
                'status' => 0
            )
        );

        $stub->expects($this->any())->method('leftFloatingWindowKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentLinkValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentPictureValidate')->willReturn(true);

        $result = $stub->leftFloatingWindowValidatePublic($content);

        $this->assertTrue($result);
    }

    //leftFloatingWindowKeysValidate
    /**
     * @dataProvider additionProviderLeftFloatingWindowKeysValidate
     */
    public function testLeftFloatingWindowKeysValidate($parameter, $expected)
    {
        $result = $this->stub->leftFloatingWindowKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderLeftFloatingWindowKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array(
                'name' => 'name',
                'link' => 'link',
                'picture' => array('picture'),
                'status' => 0
            ), true)
        );
    }

    //websiteStyleValidate
    /**
     * @dataProvider additionProviderWebsiteStyleValidate
     */
    public function testWebsiteStyleValidate($parameter, $expected)
    {
        $result = $this->stub->websiteStyleValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderWebsiteStyleValidate()
    {
        return array(
            array(array('test'), false),
            array(12222, false),
            array(HomePageConfigWidgetRule::WEBSITE_STYLE['MOURNING'], true)
        );
    }

    //silhouette
    public function testSilhouetteValidateFalse()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'silhouetteKeysValidate'
                            ])->getMock();
                            
        $content = array('link' => 'link');

        $stub->expects($this->once())->method('silhouetteKeysValidate')->willReturn(false);

        $result = $stub->silhouetteValidatePublic($content);

        $this->assertFalse($result);
    }

    public function testSilhouetteValidateTrue()
    {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'silhouetteKeysValidate',
                               'diyContentStatusValidate',
                               'diyContentNameValidate',
                               'diyContentPictureValidate',
                               'diyContentValueValidate'
                            ])->getMock();
                            
         
        $content = array('status' => 0, 'name' => 'name', 'picture' => array('a'), 'description' => 'description');

        $stub->expects($this->any())->method('silhouetteKeysValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentStatusValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentNameValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentPictureValidate')->willReturn(true);
        $stub->expects($this->any())->method('diyContentValueValidate')->willReturn(true);

        $result = $stub->silhouetteValidatePublic($content);

        $this->assertTrue($result);
    }

    //silhouetteKeysValidate
    /**
     * @dataProvider additionProviderSilhouetteKeysValidate
     */
    public function testSilhouetteKeysValidate($parameter, $expected)
    {
        $result = $this->stub->silhouetteKeysValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderSilhouetteKeysValidate()
    {
        return array(
            array(array('test'), false),
            array(array('name' => 'name', 'address'=>'address'), false),
            array(array('status' => 0, 'name' => 'name', 'picture' => 'picture', 'description' => 'description'), true)
        );
    }

    //diyContentTypeValidate
    /**
     * @dataProvider additionProviderDiyContentTypeValidate
     */
    public function testDiyContentTypeValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentTypeValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentTypeValidate()
    {
        return array(
            array(array('test'), false),
            array(12222, false),
            array(HomePageConfigWidgetRule::DIY_CONTENT_TYPE['LINK'], true)
        );
    }

    //diyContentDisplayPositionValidate
    /**
     * @dataProvider additionProviderDiyContentDisplayPositionValidate
     */
    public function testDiyContentDisplayPositionValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentDisplayPositionValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentDisplayPositionValidate()
    {
        return array(
            array(array('test'), false),
            array(12222, false),
            array(HomePageConfigWidgetRule::DIY_CONTENT_DISPLAY_POSITION['LEFT'], true)
        );
    }

    //diyContentCodeTypeValidate
    /**
     * @dataProvider additionProviderDiyContentCodeTypeValidate
     */
    public function testDiyContentCodeTypeValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentCodeTypeValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentCodeTypeValidate()
    {
        return array(
            array(array('test'), false),
            array(12222, false),
            array(HomePageConfigWidgetRule::DIY_CONTENT_CODE_TYPE['ACCESSIBLE_READING'], true)
        );
    }

    //diyContentLinkValidate
    /**
     * @dataProvider additionProviderDiyContentLinkValidate
     */
    public function testDiyContentLinkValidate($parameterOne, $parameterTwo, $expected)
    {
        $result = $this->stub->diyContentLinkValidatePublic($parameterOne, $parameterTwo);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentLinkValidate()
    {
        return array(
            array('', HomePageConfigWidgetRule::DIY_CONTENT_TYPE['LINK'], false),
            array('', HomePageConfigWidgetRule::DIY_CONTENT_TYPE['TEXT'], true),
            array('link', HomePageConfigWidgetRule::DIY_CONTENT_TYPE['TEXT'], false),
            array('link', HomePageConfigWidgetRule::DIY_CONTENT_TYPE['LINK'], true)
        );
    }

    protected function initCommonWidgetRuleValidate(
        string $validateMethod,
        string $widgetRuleMethod,
        $parameter,
        bool $result
    ) {
        $stub = $this->getMockBuilder(HomePageConfigWidgetRuleMock::class)
                           ->setMethods([
                               'getCommonWidgetRule'
                            ])->getMock();
                            
        // 为 CommonWidgetRule 类建立预言(prophecy)。
        $commonWidgetRule = $this->prophesize(CommonWidgetRule::class);
        // 建立预期状况:$widgetRuleMethod() 方法将会被调用一次。
        $commonWidgetRule->$widgetRuleMethod($parameter)->shouldBeCalled(1)->willReturn($result);
        // 为 getCommonWidgetRule() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getCommonWidgetRule'
        )->willReturn($commonWidgetRule->reveal());

        $result = $stub->$validateMethod($parameter);

        if ($result) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function testDiyContentNameValidateFalse()
    {
        $this->initCommonWidgetRuleValidate('diyContentNameValidatePublic', 'name', 'name', false);
    }

    public function testDiyContentNameValidateTrue()
    {
        $this->initCommonWidgetRuleValidate('diyContentNameValidatePublic', 'name', 'name', true);
    }

    public function testDiyContentStatusValidateFalse()
    {
        $this->initCommonWidgetRuleValidate('diyContentStatusValidatePublic', 'status', 0, false);
    }

    public function testDiyContentStatusValidateTrue()
    {
        $this->initCommonWidgetRuleValidate('diyContentStatusValidatePublic', 'status', 0, true);
    }

    public function testDiyContentPictureValidateFalse()
    {
        $this->initCommonWidgetRuleValidate('diyContentPictureValidatePublic', 'picture', array('picture'), false);
    }

    public function testDiyContentPictureValidateTrue()
    {
        $this->initCommonWidgetRuleValidate('diyContentPictureValidatePublic', 'picture', array('picture'), true);
    }

    public function testDiyContentIntValidateFalse()
    {
        $this->initCommonWidgetRuleValidate('diyContentIntValidatePublic', 'isNumericType', 0, false);
    }

    public function testDiyContentIntValidateTrue()
    {
        $this->initCommonWidgetRuleValidate('diyContentIntValidatePublic', 'isNumericType', 0, true);
    }

    public function testDiyContentValueValidateFalse()
    {
        $this->initCommonWidgetRuleValidate('diyContentValueValidatePublic', 'description', 'description', false);
    }

    public function testDiyContentValueValidateTrue()
    {
        $this->initCommonWidgetRuleValidate('diyContentValueValidatePublic', 'description', 'description', true);
    }

    public function testRightNavPicturesValidateFalse()
    {
        $this->initCommonWidgetRuleValidate('rightNavPicturesValidatePublic', 'pictures', ['pictures'], false);
    }

    public function testRightNavPicturesValidateTrue()
    {
        $this->initCommonWidgetRuleValidate('rightNavPicturesValidatePublic', 'pictures', ['pictures'], true);
    }
}
