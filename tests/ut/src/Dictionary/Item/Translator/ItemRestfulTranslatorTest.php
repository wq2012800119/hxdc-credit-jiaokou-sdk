<?php
namespace Sdk\Dictionary\Item\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Dictionary\Item\Utils\MockObjectGenerate;
use Sdk\Dictionary\Item\Utils\TranslatorUtilsTrait;

use Sdk\Dictionary\Category\Translator\CategoryRestfulTranslator;
use Sdk\Dictionary\Category\Utils\MockObjectGenerate as CategoryMockObjectGenerate;

class ItemRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ItemRestfulTranslator();
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

    public function testGetCategoryRestfulTranslator()
    {
        $stub = new ItemRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Dictionary\Category\Translator\CategoryRestfulTranslator',
            $stub->getCategoryRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Dictionary\Item\Model\NullItem',
            $result
        );
    }

    public function testArrayToObject()
    {
        $item = MockObjectGenerate::generateItem(1);

        $expression['data']['id'] = $item->getId();
        $expression['data']['attributes']['name'] = $item->getName();
        $expression['data']['attributes']['status'] = $item->getStatus();
        $expression['data']['attributes']['statusTime'] = $item->getStatusTime();
        $expression['data']['attributes']['createTime'] = $item->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $item->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Dictionary\Item\Model\Item',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $stub = $this->getMockBuilder(ItemRestfulTranslatorMock::class)
                           ->setMethods([
                               'includedFormatConversion',
                               'relationshipFill',
                               'getCategoryRestfulTranslator'
                            ])->getMock();

        $relationships = array(
            'dictionaryCategory' => array('dictionaryCategory')
        );
        $included = array('included');
        $expression['data']['relationships'] = $relationships;
        $expression['included'] = $included;

        $includedConversion = array('includedConversion');
        $categoryArray = array('categoryArray');
        $category = CategoryMockObjectGenerate::generateCategory(1);

        $stub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);

        $stub->expects($this->exactly(1))->method(
            'relationshipFill'
        )->with($relationships['dictionaryCategory'], $includedConversion)->willReturn($categoryArray);

        // 为 CategoryRestfulTranslator 类建立预言(prophecy)。
        $restfulTranslator = $this->prophesize(CategoryRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $restfulTranslator->arrayToObject($categoryArray)->shouldBeCalled(1)->willReturn($category);
        // 为 getCategoryRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getCategoryRestfulTranslator'
        )->willReturn($restfulTranslator->reveal());

        $result = $stub->arrayToObject($expression);
        $this->assertInstanceOf(
            'Sdk\Dictionary\Item\Model\Item',
            $result
        );

        $this->assertEquals($category, $result->getCategory());
    }

    public function testObjectToArrayEmpty()
    {
        $item = array();
        $result = $this->stub->objectToArray($item);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $item = MockObjectGenerate::generateItem(1);

        $result = $this->stub->objectToArray($item);
        $this->compareRestfulTranslatorEquals($item, $result);
    }
}
