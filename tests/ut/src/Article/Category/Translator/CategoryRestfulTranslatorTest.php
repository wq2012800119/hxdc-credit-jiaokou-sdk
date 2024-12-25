<?php
namespace Sdk\Article\Category\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Article\Category\Utils\MockObjectGenerate;
use Sdk\Article\Category\Utils\TranslatorUtilsTrait;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;

class CategoryRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new CategoryRestfulTranslator();
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
        $stub = new CategoryRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffRestfulTranslator',
            $stub->getStaffRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Article\Category\Model\NullCategory',
            $result
        );
    }

    public function testArrayToObject()
    {
        $category = MockObjectGenerate::generateCategory(1);
        $category->setParentCategoryId(1);

        $expression['data']['id'] = $category->getId();
        $expression['data']['attributes']['name'] = $category->getName();
        $expression['data']['attributes']['level'] = $category->getLevel();
        $expression['data']['attributes']['style'] = $category->getStyle();
        $expression['data']['attributes']['diyContent'] = $category->getDiyContent();
        $expression['data']['attributes']['parentCategory'] = $category->getParentCategoryId();
        $expression['data']['attributes']['parentCategoryName'] = $category->getParentCategoryName();
        $expression['data']['attributes']['status'] = $category->getStatus();
        $expression['data']['attributes']['statusTime'] = $category->getStatusTime();
        $expression['data']['attributes']['createTime'] = $category->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $category->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Article\Category\Model\Category',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $stub = $this->getMockBuilder(CategoryRestfulTranslatorMock::class)
                           ->setMethods([
                               'includedFormatConversion',
                               'relationshipFill',
                               'getStaffRestfulTranslator'
                            ])->getMock();

        $relationships = array(
            'staff' => array('staff')
        );
        $included = array('included');
        $expression['data']['relationships'] = $relationships;
        $expression['included'] = $included;

        $includedConversion = array('includedConversion');
        $staffArray = array('staffArray');
        $staff = StaffMockObjectGenerate::generateStaff(1);

        $stub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);

        $stub->expects($this->exactly(1))->method(
            'relationshipFill'
        )->with($relationships['staff'], $includedConversion)->willReturn($staffArray);

        // 为 StaffRestfulTranslator 类建立预言(prophecy)。
        $restfulTranslator = $this->prophesize(StaffRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $restfulTranslator->arrayToObject($staffArray)->shouldBeCalled(1)->willReturn($staff);
        // 为 getStaffRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getStaffRestfulTranslator'
        )->willReturn($restfulTranslator->reveal());

        $result = $stub->arrayToObject($expression);
        $this->assertInstanceOf(
            'Sdk\Article\Category\Model\Category',
            $result
        );

        $this->assertEquals($staff, $result->getStaff());
    }

    public function testObjectToArrayEmpty()
    {
        $category = array();
        $result = $this->stub->objectToArray($category);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $category = MockObjectGenerate::generateCategory(1);

        $result = $this->stub->objectToArray($category);

        $this->compareRestfulTranslatorEquals($category, $result);
    }
}
