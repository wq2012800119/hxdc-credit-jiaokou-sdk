<?php
namespace Sdk\Article\Article\Model;

use PHPUnit\Framework\TestCase;

use Sdk\Article\Category\Model\Category;
use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\Organization\Organization\Model\Organization;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ArticleTest extends TestCase
{
    private $articleStub;

    protected function setUp(): void
    {
        $this->articleStub = new Article();
    }

    protected function tearDown(): void
    {
        unset($this->articleStub);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->articleStub
        );
    }

    public function testImplementsIOperateAble()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Model\Interfaces\IOperateAble',
            $this->articleStub
        );
    }

    public function testImplementsITopAble()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Model\Interfaces\ITopAble',
            $this->articleStub
        );
    }

    public function testImplementsIExamineAble()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Model\Interfaces\IExamineAble',
            $this->articleStub
        );
    }
    /**
     * Article 领域对象,测试构造函数
     */
    public function testArticleConstructor()
    {
        $this->assertEmpty($this->articleStub->getId());
        $this->assertEmpty($this->articleStub->getTitle());
        $this->assertEmpty($this->articleStub->getSource());
        $this->assertEmpty($this->articleStub->getPubDate());
        $this->assertEmpty($this->articleStub->getDescription());
        $this->assertEmpty($this->articleStub->getCover());
        $this->assertEmpty($this->articleStub->getAttachments());
        $this->assertEmpty($this->articleStub->getContent());
        $this->assertEquals(Article::IS_SLIDES['NO'], $this->articleStub->getIsSlides());
        $this->assertEquals(Article::IS_HOME_SLIDES['NO'], $this->articleStub->getIsHomeSlides());
        $this->assertEmpty($this->articleStub->getSlidesPicture());
        $this->assertInstanceOf(
            'Sdk\Article\Category\Model\Category',
            $this->articleStub->getParentCategory()
        );
        $this->assertInstanceOf(
            'Sdk\Article\Category\Model\Category',
            $this->articleStub->getCategory()
        );
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\Organization',
            $this->articleStub->getOrganization()
        );
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\Staff',
            $this->articleStub->getStaff()
        );
        $this->assertEquals(Article::TOP_STATUS['NO_TOP'], $this->articleStub->getTopStatus());
        $this->assertEquals(Article::EXAMINE_STATUS['PENDING'], $this->articleStub->getExamineStatus());
        $this->assertEquals(Article::STATUS['ENABLED'], $this->articleStub->getStatus());
        $this->assertEmpty($this->articleStub->getCreateTime());
        $this->assertEmpty($this->articleStub->getUpdateTime());
        $this->assertEmpty($this->articleStub->getStatusTime());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 Article setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->articleStub->setId(4);
        $this->assertEquals(4, $this->articleStub->getId());
    }

    /**
     * 设置 Article setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->articleStub->setId('1');
        $this->assertTrue(is_int($this->articleStub->getId()));
        $this->assertEquals(1, $this->articleStub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //title 测试 -------------------------------------------------------- start
    /**
     * 设置 Article setTitle() 正确的传参类型,期望传值正确
     */
    public function testSetTitleCorrectType()
    {
        $this->articleStub->setTitle('articleTitle');
        $this->assertEquals('articleTitle', $this->articleStub->getTitle());
    }

    /**
     * 设置 Article setTitle() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetTitleWrongType()
    {
        $this->articleStub->setTitle(array('articleTitle'));
    }
    //title 测试 --------------------------------------------------------   end

    //source 测试 -------------------------------------------------------- start
    /**
     * 设置 Article setSource() 正确的传参类型,期望传值正确
     */
    public function testSetSourceCorrectType()
    {
        $this->articleStub->setSource('source');
        $this->assertEquals('source', $this->articleStub->getSource());
    }

    /**
     * 设置 Article setSource() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSourceWrongType()
    {
        $this->articleStub->setSource(array('source'));
    }
    //source 测试 --------------------------------------------------------   end

    //parentCategory 测试 -------------------------------------------------------- start
    /**
     * 设置 Article setParentCategory() 正确的传参类型,期望传值正确
     */
    public function testSetParentCategoryCorrectType()
    {
        $parentCategory = new Category();
        $this->articleStub->setParentCategory($parentCategory);
        $this->assertEquals($parentCategory, $this->articleStub->getParentCategory());
    }

    /**
     * 设置 Article setParentCategory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetParentCategoryWrongType()
    {
        $this->articleStub->setParentCategory(array('parentCategory'));
    }
    //parentCategory 测试 --------------------------------------------------------   end

    //category 测试 -------------------------------------------------------- start
    /**
     * 设置 Article setCategory() 正确的传参类型,期望传值正确
     */
    public function testSetCategoryCorrectType()
    {
        $category = new Category();
        $this->articleStub->setCategory($category);
        $this->assertEquals($category, $this->articleStub->getCategory());
    }

    /**
     * 设置 Article setCategory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetCategoryWrongType()
    {
        $this->articleStub->setCategory(array('category'));
    }
    //category 测试 --------------------------------------------------------   end

    //pubDate 测试 -------------------------------------------------------- start
    /**
     * 设置 Article setPubDate() 正确的传参类型,期望传值正确
     */
    public function testSetPubDateCorrectType()
    {
        $this->articleStub->setPubDate(16729394123);
        $this->assertEquals(16729394123, $this->articleStub->getPubDate());
    }

    /**
     * 设置 Article setPubDate() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetPubDateWrongType()
    {
        $this->articleStub->setPubDate(array('pubDate'));
    }
    //pubDate 测试 --------------------------------------------------------   end

    //description 测试 -------------------------------------------------------- start
    /**
     * 设置 Article setDescription() 正确的传参类型,期望传值正确
     */
    public function testSetDescriptionCorrectType()
    {
        $this->articleStub->setDescription('description');
        $this->assertEquals('description', $this->articleStub->getDescription());
    }

    /**
     * 设置 Article setDescription() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDescriptionWrongType()
    {
        $this->articleStub->setDescription(array('description'));
    }
    //description 测试 --------------------------------------------------------   end

    //cover 测试 -------------------------------------------------------- start
    /**
     * 设置 Article setCover() 正确的传参类型,期望传值正确
     */
    public function testSetCoverCorrectType()
    {
        $this->articleStub->setCover(array('cover'));
        $this->assertEquals(array('cover'), $this->articleStub->getCover());
    }

    /**
     * 设置 Article setCover() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetCoverWrongType()
    {
        $this->articleStub->setCover('cover');
    }
    //cover 测试 --------------------------------------------------------   end

    //attachments 测试 -------------------------------------------------------- start
    /**
     * 设置 Article setAttachments() 正确的传参类型,期望传值正确
     */
    public function testSetAttachmentsCorrectType()
    {
        $this->articleStub->setAttachments(array('attachments'));
        $this->assertEquals(array('attachments'), $this->articleStub->getAttachments());
    }

    /**
     * 设置 Article setAttachments() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetAttachmentsWrongType()
    {
        $this->articleStub->setAttachments('attachments');
    }
    //attachments 测试 --------------------------------------------------------   end
    //content 测试 -------------------------------------------------------- start
    /**
     * 设置 Article setContent() 正确的传参类型,期望传值正确
     */
    public function testSetContentCorrectType()
    {
        $this->articleStub->setContent(array('content'));
        $this->assertEquals(array('content'), $this->articleStub->getContent());
    }

    /**
     * 设置 Article setContent() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetContentWrongType()
    {
        $this->articleStub->setContent('content');
    }
    //content 测试 --------------------------------------------------------   end

    //isSlides 测试 ------------------------------------------------------ start
    /**
     * @dataProvider additionProviderIsSlides
     */
    public function testSetIsSlides($parameter, $expected)
    {
        $this->articleStub->setIsSlides($parameter);
        $this->assertEquals($expected, $this->articleStub->getIsSlides());
    }

    /**
     * 循环测试 Article setIsSlides() 数据构建器
     */
    public function additionProviderIsSlides()
    {
        return array(
            array(Article::IS_SLIDES['NO'], Article::IS_SLIDES['NO']),
            array(Article::IS_SLIDES['YES'], Article::IS_SLIDES['YES']),
            array(9999, Article::IS_SLIDES['NO']),
        );
    }
    /**
     * 设置 Article setIsSlides() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetIsSlidesWrongType()
    {
        $this->articleStub->setIsSlides('string');
    }
    //isSlides 测试 ------------------------------------------------------   end

    //isHomeSlides 测试 ------------------------------------------------------ start
    /**
     * @dataProvider additionProviderIsHomeSlides
     */
    public function testSetIsHomeSlides($parameter, $expected)
    {
        $this->articleStub->setIsHomeSlides($parameter);
        $this->assertEquals($expected, $this->articleStub->getIsHomeSlides());
    }

    /**
     * 循环测试 Article setIsHomeSlides() 数据构建器
     */
    public function additionProviderIsHomeSlides()
    {
        return array(
            array(Article::IS_HOME_SLIDES['NO'], Article::IS_HOME_SLIDES['NO']),
            array(Article::IS_HOME_SLIDES['YES'], Article::IS_HOME_SLIDES['YES']),
            array(9999, Article::IS_HOME_SLIDES['NO']),
        );
    }
    /**
     * 设置 Article setIsHomeSlides() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetIsHomeSlidesWrongType()
    {
        $this->articleStub->setIsHomeSlides('string');
    }
    //isHomeSlides 测试 ------------------------------------------------------   end

    //slidesPicture 测试 -------------------------------------------------------- start
    /**
     * 设置 Article setSlidesPicture() 正确的传参类型,期望传值正确
     */
    public function testSetSlidesPictureCorrectType()
    {
        $this->articleStub->setSlidesPicture(array('slidesPicture'));
        $this->assertEquals(array('slidesPicture'), $this->articleStub->getSlidesPicture());
    }

    /**
     * 设置 Article setSlidesPicture() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSlidesPictureWrongType()
    {
        $this->articleStub->setSlidesPicture('slidesPicture');
    }
    //slidesPicture 测试 --------------------------------------------------------   end

    //organization 测试 -------------------------------------------------------- start
    /**
     * 设置 Article setOrganization() 正确的传参类型,期望传值正确
     */
    public function testSetOrganizationCorrectType()
    {
        $organization = new Organization();
        $this->articleStub->setOrganization($organization);
        $this->assertEquals($organization, $this->articleStub->getOrganization());
    }

    /**
     * 设置 Article setOrganization() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetOrganizationWrongType()
    {
        $this->articleStub->setOrganization(array('organization'));
    }
    //organization 测试 --------------------------------------------------------   end

    //staff 测试 -------------------------------------------------------- start
    /**
     * 设置 Article setStaff() 正确的传参类型,期望传值正确
     */
    public function testSetStaffCorrectType()
    {
        $staff = new OrganizationUserStaff();
        $this->articleStub->setStaff($staff);
        $this->assertEquals($staff, $this->articleStub->getStaff());
    }

    /**
     * 设置 Article setStaff() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStaffWrongType()
    {
        $this->articleStub->setStaff(array('staff'));
    }
    //staff 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $articleStub = new ArticleMock();
        $this->assertInstanceOf(
            'Sdk\Article\Article\Repository\ArticleRepository',
            $articleStub->getRepositoryPublic()
        );
    }
}
