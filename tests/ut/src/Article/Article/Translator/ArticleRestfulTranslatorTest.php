<?php
namespace Sdk\Article\Article\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Article\Article\Utils\MockObjectGenerate;
use Sdk\Article\Article\Utils\TranslatorUtilsTrait;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;

use Sdk\Article\Category\Translator\CategoryRestfulTranslator;
use Sdk\Article\Category\Utils\MockObjectGenerate as CategoryMockObjectGenerate;

use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;
use Sdk\Organization\Organization\Utils\MockObjectGenerate as OrganizationMockObjectGenerate;

class ArticleRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ArticleRestfulTranslator();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIRestfulTranslator()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\IRestfulTranslator',
            $this->stub
        );
    }

    public function testGetStaffRestfulTranslator()
    {
        $stub = new ArticleRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffRestfulTranslator',
            $stub->getStaffRestfulTranslatorPublic()
        );
    }

    public function testGetCategoryRestfulTranslator()
    {
        $stub = new ArticleRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Article\Category\Translator\CategoryRestfulTranslator',
            $stub->getCategoryRestfulTranslatorPublic()
        );
    }

    public function testGetOrganizationRestfulTranslator()
    {
        $stub = new ArticleRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator',
            $stub->getOrganizationRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Article\Article\Model\NullArticle',
            $result
        );
    }

    public function testArrayToObject()
    {
        $article = MockObjectGenerate::generateArticle(1);

        $expression['data']['id'] = $article->getId();
        $expression['data']['attributes']['title'] = $article->getTitle();
        $expression['data']['attributes']['source'] = $article->getSource();
        $expression['data']['attributes']['pubDate'] = $article->getPubDate();
        $expression['data']['attributes']['description'] = $article->getDescription();
        $expression['data']['attributes']['cover'] = $article->getCover();
        $expression['data']['attributes']['attachments'] = $article->getAttachments();
        $expression['data']['attributes']['content'] = $article->getContent();
        $expression['data']['attributes']['isSlides'] = $article->getIsSlides();
        $expression['data']['attributes']['isHomeSlides'] = $article->getIsHomeSlides();
        $expression['data']['attributes']['slidesPicture'] = $article->getSlidesPicture();
        $expression['data']['attributes']['topStatus'] = $article->getTopStatus();
        $expression['data']['attributes']['examineStatus'] = $article->getExamineStatus();
        $expression['data']['attributes']['status'] = $article->getStatus();
        $expression['data']['attributes']['statusTime'] = $article->getStatusTime();
        $expression['data']['attributes']['createTime'] = $article->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $article->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Article\Article\Model\Article',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $stub = $this->getMockBuilder(ArticleRestfulTranslatorMock::class)
                           ->setMethods([
                               'includedFormatConversion',
                               'relationshipFill',
                               'getCategoryRestfulTranslator',
                               'getOrganizationRestfulTranslator',
                               'getStaffRestfulTranslator'
                            ])->getMock();

        $relationships = array(
            'category' => array('category'),
            'organization' => array('organization'),
            'staff' => array('staff')
        );
        $included = array('included');
        $expression['data']['relationships'] = $relationships;
        $expression['included'] = $included;

        $includedConversion = array('includedConversion');
        $categoryArray = array('categoryArray');
        $category = CategoryMockObjectGenerate::generateCategory(1);
        $organizationArray = array('organizationArray');
        $organization = OrganizationMockObjectGenerate::generateOrganization(1);
        $staffArray = array('staffArray');
        $staff = StaffMockObjectGenerate::generateStaff(1);
        $stub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);

        $stub->expects($this->exactly(3))->method('relationshipFill')
            ->will($this->returnValueMap([
                [
                    $relationships['category'], $includedConversion, $categoryArray
                ],
                [
                    $relationships['organization'], $includedConversion, $organizationArray
                ],
                [
                    $relationships['staff'], $includedConversion, $staffArray
                ]
            ]));

        // 为 CategoryRestfulTranslator 类建立预言(prophecy)。
        $categoryRestfulTranslator = $this->prophesize(CategoryRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $categoryRestfulTranslator->arrayToObject($categoryArray)->shouldBeCalled(1)->willReturn($category);
        // 为 getCategoryRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getCategoryRestfulTranslator'
        )->willReturn($categoryRestfulTranslator->reveal());

        // 为 OrganizationRestfulTranslator 类建立预言(prophecy)。
        $organizationRestfulTranslator = $this->prophesize(OrganizationRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $organizationRestfulTranslator->arrayToObject(
            $organizationArray
        )->shouldBeCalled(1)->willReturn($organization);
        // 为 getOrganizationRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getOrganizationRestfulTranslator'
        )->willReturn($organizationRestfulTranslator->reveal());

        // 为 StaffRestfulTranslator 类建立预言(prophecy)。
        $staffRestfulTranslator = $this->prophesize(StaffRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $staffRestfulTranslator->arrayToObject($staffArray)->shouldBeCalled(1)->willReturn($staff);
        // 为 getStaffRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getStaffRestfulTranslator'
        )->willReturn($staffRestfulTranslator->reveal());

        $result = $stub->arrayToObject($expression);
        $this->assertInstanceOf(
            'Sdk\Article\Article\Model\Article',
            $result
        );

        $this->assertEquals($category, $result->getCategory());
        $this->assertEquals($organization, $result->getOrganization());
        $this->assertEquals($staff, $result->getStaff());
    }

    public function testObjectToArrayEmpty()
    {
        $article = array();
        $result = $this->stub->objectToArray($article);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $article = MockObjectGenerate::generateArticle(1);

        $result = $this->stub->objectToArray($article);
        $this->compareRestfulTranslatorEquals($article, $result);
    }
}
