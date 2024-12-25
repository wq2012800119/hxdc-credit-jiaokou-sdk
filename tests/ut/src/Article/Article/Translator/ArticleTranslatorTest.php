<?php
namespace Sdk\Article\Article\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\Interfaces\ITopAble;
use Sdk\Common\Model\Interfaces\IOperateAble;
use Sdk\Common\Model\Interfaces\IExamineAble;

use Sdk\Article\Article\Model\Article;
use Sdk\Article\Article\Utils\MockObjectGenerate;
use Sdk\Article\Article\Utils\TranslatorUtilsTrait;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Article\Category\Translator\CategoryTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class ArticleTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ArticleTranslator();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsITranslator()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\ITranslator',
            $this->stub
        );
    }

    public function testGetStaffTranslator()
    {
        $stub = new ArticleTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffTranslator',
            $stub->getStaffTranslatorPublic()
        );
    }

    public function testGetCategoryTranslator()
    {
        $stub = new ArticleTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Article\Category\Translator\CategoryTranslator',
            $stub->getCategoryTranslatorPublic()
        );
    }

    public function testGetOrganizationTranslator()
    {
        $stub = new ArticleTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationTranslator',
            $stub->getOrganizationTranslatorPublic()
        );
    }

    public function testGetNullObject()
    {
        $stub = new ArticleTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Article\Article\Model\NullArticle',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $article = array();
        $result = $this->stub->objectToArray($article);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(ArticleTranslatorMock::class)
                           ->setMethods([
                               'typeFormatConversion',
                               'statusFormatConversion',
                               'getCategoryTranslator',
                               'getOrganizationTranslator',
                               'getStaffTranslator'
                            ])->getMock();

        $article = MockObjectGenerate::generateArticle(1);
        $article->setIsSlides(Article::IS_SLIDES['NO']);
        $article->setIsHomeSlides(Article::IS_HOME_SLIDES['YES']);
        $article->setCategory($article->getParentCategory());
        list(
            $categoryArray,
            $organizationArray,
            $staffArray
        ) = $this->relationObjectToArray($article, $stub);
        list($isSlidesArray, $isHomeSlidesArray) = $this->typeFormatConversion($article, $stub);
        list($statusArray, $topStatusArray, $examineStatusArray) = $this->statusFormatConversion($article, $stub);
 
        $result = $stub->objectToArray($article);

        $this->assertEquals($result['isSlides'], $isSlidesArray);
        $this->assertEquals($result['isHomeSlides'], $isHomeSlidesArray);
        $this->assertEquals($result['status'], $statusArray);
        $this->assertEquals($result['topStatus'], $topStatusArray);
        $this->assertEquals($result['examineStatus'], $examineStatusArray);
        $this->assertEquals($result['category'], $categoryArray);
        $this->assertEquals($result['organization'], $organizationArray);
        $this->assertEquals($result['staff'], $staffArray);
        
        $this->compareTranslatorEquals($result, $article);
    }

    private function typeFormatConversion(Article $article, $stub) : array
    {
        $isSlidesArray = array('isSlides');
        $isHomeSlidesArray = array('isHomeSlides');
        $stub->expects($this->exactly(2))->method('typeFormatConversion')
            ->will($this->returnValueMap([
                [
                    $article->getIsSlides(), Article::IS_SLIDES_CN, $isSlidesArray
                ],
                [
                    $article->getIsHomeSlides(), Article::IS_HOME_SLIDES_CN, $isHomeSlidesArray
                ]
            ]));

        return [$isSlidesArray, $isHomeSlidesArray];
    }

    private function statusFormatConversion(Article $article, $stub) : array
    {
        $statusArray = array('status');
        $topStatusArray = array('topStatus');
        $examineStatusArray = array('examineStatus');
        $stub->expects($this->exactly(3))->method('statusFormatConversion')
            ->will($this->returnValueMap([
                [
                    $article->getStatus(), IOperateAble::STATUS_TYPE, IOperateAble::STATUS_CN, $statusArray
                ],
                [
                    $article->getTopStatus(), ITopAble::TOP_STATUS_TYPE, ITopAble::TOP_STATUS_CN, $topStatusArray
                ],
                [
                    $article->getExamineStatus(),
                    IExamineAble::EXAMINE_STATUS_TYPE,
                    IExamineAble::EXAMINE_STATUS_CN,
                    $examineStatusArray
                ]
            ]));

        return [$statusArray, $topStatusArray, $examineStatusArray];
    }

    private function relationObjectToArray(Article $article, $stub) : array
    {
        $categoryArray = $this->categoryRelationObjectToArray($article, $stub);
        $organizationArray = $this->organizationRelationObjectToArray($article, $stub);
        $staffArray = $this->staffRelationObjectToArray($article, $stub);

        return [$categoryArray, $organizationArray, $staffArray];
    }

    private function categoryRelationObjectToArray(Article $article, $stub) : array
    {
        $category = $article->getCategory();
        $categoryArray = array('categoryArray');
       
        // 为 CategoryTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(CategoryTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $category,
            ['id', 'name', 'parentCategory']
        )->shouldBeCalled(2)->willReturn($categoryArray);
        // 为 getCategoryTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->any())->method(
            'getCategoryTranslator'
        )->willReturn($translator->reveal());

        return $categoryArray;
    }

    private function organizationRelationObjectToArray(Article $article, $stub) : array
    {
        $organization = $article->getOrganization();
        $organizationArray = array('organizationArray');

        // 为 OrganizationTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(OrganizationTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $organization,
            ['id', 'name']
        )->shouldBeCalled(1)->willReturn($organizationArray);
        // 为 getOrganizationTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getOrganizationTranslator'
        )->willReturn($translator->reveal());

        return $organizationArray;
    }

    private function staffRelationObjectToArray(Article $article, $stub) : array
    {
        $staff = $article->getStaff();
        $staffArray = array('staffArray');

        // 为 StaffTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(StaffTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $staff,
            ['id', 'subjectName']
        )->shouldBeCalled(1)->willReturn($staffArray);
        // 为 getStaffTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getStaffTranslator'
        )->willReturn($translator->reveal());

        return $staffArray;
    }
}
