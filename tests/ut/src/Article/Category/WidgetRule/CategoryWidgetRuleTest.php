<?php
namespace Sdk\Article\Category\WidgetRule;

use Marmot\Core;
use PHPUnit\Framework\TestCase;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Article\Category\Model\Category;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class CategoryWidgetRuleTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new CategoryWidgetRuleMock();
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
    //level
    /**
     * @dataProvider additionProviderLevel
     */
    public function testLevel($parameter, $expected)
    {
        $result = $this->stub->level($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ARTICLE_CATEGORY_LEVEL_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderLevel()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(Category::LEVEL['ONE_LEVEL'], true),
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
        $this->assertEquals(ARTICLE_CATEGORY_STYLE_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderStyle()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(Category::STYLE['STYLE_ONE'], true),
        );
    }
    //parentCategory
    /**
     * @dataProvider additionProviderParentCategory
     */
    public function testParentCategory($parameterOne, $parameterTwo, $expected)
    {
        $result = $this->stub->parentCategory($parameterOne, $parameterTwo);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ARTICLE_CATEGORY_PARENT_CATEGORY_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderParentCategory()
    {
        return array(
            array('', '', false),
            array(array(1), Category::LEVEL['ONE_LEVEL'], false),
            array(1, Category::LEVEL['ONE_LEVEL'], false),
            array(1, Category::LEVEL['SECOND_LEVEL'], true)
        );
    }

    public function testDiyContent()
    {
        $stub = $this->getMockBuilder(CategoryWidgetRule::class)
                           ->setMethods([
                               'diyContentTypeFormatValidate',
                               'diyContentKeysFormatValidate',
                               'diyContentSlidesPictureDisplayStatusValidate',
                               'diyContentRightToolbarDisplayStatusValidate',
                               'diyContentChildrenCategoriesValidate'
                            ])->getMock();

        $diyContent = $style = array('diyContent');

        $stub->expects($this->once())->method('diyContentTypeFormatValidate')->with($diyContent)->willReturn(true);
        $stub->expects($this->once())->method('diyContentKeysFormatValidate')->with($diyContent)->willReturn(true);
        $stub->expects($this->once())->method(
            'diyContentSlidesPictureDisplayStatusValidate'
        )->with($diyContent)->willReturn(true);
        $stub->expects($this->once())->method(
            'diyContentRightToolbarDisplayStatusValidate'
        )->with($diyContent)->willReturn(true);
        $stub->expects($this->once())->method(
            'diyContentChildrenCategoriesValidate'
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
        $this->assertEquals(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentTypeFormatValidate()
    {
        return array(
            array('', false),
            array(array(), false),
            array(array(9999), true)
        );
    }

    //diyContentKeysFormatValidate
    /**
     * @dataProvider additionProviderDiyContentKeysFormatValidate
     */
    public function testDiyContentKeysFormatValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentKeysFormatValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentKeysFormatValidate()
    {
        $diyContent = array();

        foreach (CategoryWidgetRule::DIY_CONTENT_KEYS as $value) {
            $diyContent[$value] = $value;
        }

        return array(
            array(array(), false),
            array(array('aa'), false),
            array($diyContent, true)
        );
    }

    //diyContentSlidesPictureDisplayStatusValidate
    /**
     * @dataProvider additionProviderDiyContentSlidesPictureDisplayStatusValidate
     */
    public function testDiyContentSlidesPictureDisplayStatusValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentSlidesPictureDisplayStatusValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentSlidesPictureDisplayStatusValidate()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(array('slidesPictureDisplayStatus' => 'dataType'), false),
            array(array('slidesPictureDisplayStatus' => IOperateAble::STATUS['ENABLED']), true)
        );
    }

    //diyContentRightToolbarDisplayStatusValidate
    /**
     * @dataProvider additionProviderDiyContentRightToolbarDisplayStatusValidate
     */
    public function testDiyContentRightToolbarDisplayStatusValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentRightToolbarDisplayStatusValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentRightToolbarDisplayStatusValidate()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(array('rightToolbarDisplayStatus' => 'dataType'), false),
            array(array('rightToolbarDisplayStatus' => IOperateAble::STATUS['ENABLED']), true)
        );
    }

    public function testDiyContentChildrenCategoriesValidate()
    {
        $stub = $this->getMockBuilder(CategoryWidgetRuleMock::class)
                           ->setMethods([
                               'diyContentChildrenCategoriesTypeFormatValidate',
                               'diyContentChildrenCategoriesUniqueValidate',
                               'diyContentChildrenCategoriesFormatValidate'
                            ])->getMock();

        $diyContent = $style = array('diyContent');

        $stub->expects($this->once())->method(
            'diyContentChildrenCategoriesTypeFormatValidate'
        )->with($diyContent)->willReturn(true);
        $stub->expects($this->once())->method(
            'diyContentChildrenCategoriesUniqueValidate'
        )->with($diyContent)->willReturn(true);
        $stub->expects($this->once())->method(
            'diyContentChildrenCategoriesFormatValidate'
        )->with($diyContent, $style)->willReturn(true);

        $result = $stub->diyContentChildrenCategoriesValidatePublic($diyContent, $style);
        $this->assertTrue($result);
    }

    //diyContentChildrenCategoriesTypeFormatValidate
    /**
     * @dataProvider additionProviderDiyContentChildrenCategoriesTypeFormatValidate
     */
    public function testDiyContentChildrenCategoriesTypeFormatValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentChildrenCategoriesTypeFormatValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentChildrenCategoriesTypeFormatValidate()
    {
        return array(
            array('', false),
            array(array(1), false),
            array(array('childrenCategories' => array()), false),
            array(array('childrenCategories' => array('childrenCategories')), true)
        );
    }

    //diyContentChildrenCategoriesUniqueValidate
    /**
     * @dataProvider additionProviderDiyContentChildrenCategoriesUniqueValidate
     */
    public function testDiyContentChildrenCategoriesUniqueValidate($parameter, $expected)
    {
        $result = $this->stub->diyContentChildrenCategoriesUniqueValidatePublic($parameter);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentChildrenCategoriesUniqueValidate()
    {
        return array(
            array(array('childrenCategories' => array(
                array('category' => 1),
                array('category' => 1),
                array('category' => 2)
            )), false),
            array(array('childrenCategories' => array(
                array('category' => 1),
                array('category' => 2),
                array('category' => 3)
            )), true),
        );
    }

    //diyContentChildrenCategoriesFormatValidate
    /**
     * @dataProvider additionProviderDiyContentChildrenCategoriesFormatValidate
     */
    public function testDiyContentChildrenCategoriesFormatValidate($parameterOne, $parameterTwo, $expected)
    {
        $result = $this->stub->diyContentChildrenCategoriesFormatValidatePublic($parameterOne, $parameterTwo);

        if ($expected) {
            $this->assertTrue($result);
            return ;
        }

        $this->assertFalse($result);
        $this->assertEquals(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT, Core::getLastError()->getId());
    }

    public function additionProviderDiyContentChildrenCategoriesFormatValidate()
    {
        return array(
            array(array('childrenCategories' => array(
                array('category' => 1)
            )), Category::STYLE['STYLE_TWO'], false),
            array(array('childrenCategories' => array(
                array('category' => 'category', 'status' => 1)
            )), Category::STYLE['STYLE_TWO'], false),
            array(array('childrenCategories' => array(
                array('category' => 1, 'status' => 9999)
            )), Category::STYLE['STYLE_TWO'], false),
            array(array('childrenCategories' => array(
                array('category' => 1, 'status' => IOperateAble::STATUS['ENABLED'])
            )), Category::STYLE['STYLE_TWO'], true),
            array(array('childrenCategories' => array(
                array('category' => 1, 'status' => IOperateAble::STATUS['ENABLED'])
            )), Category::STYLE['STYLE_ONE'], false),
            array(array('childrenCategories' => array(
                array('category' => 1, 'status' => IOperateAble::STATUS['ENABLED'], 'picture' => array('picture'))
            )), Category::STYLE['STYLE_ONE'], false),
            array(array('childrenCategories' => array(
                array(
                    'category' => 1,
                    'status' => IOperateAble::STATUS['ENABLED'],
                    'picture' => array('name' => 'name', 'address' => 'address.png')
                )
            )), Category::STYLE['STYLE_ONE'], true),
        );
    }
}
