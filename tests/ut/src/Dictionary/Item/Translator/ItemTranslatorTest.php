<?php
namespace Sdk\Dictionary\Item\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Dictionary\Item\Utils\MockObjectGenerate;
use Sdk\Dictionary\Item\Utils\TranslatorUtilsTrait;

use Sdk\Dictionary\Category\Translator\CategoryTranslator;

class ItemTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ItemTranslator();
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

    public function testGetCategoryTranslator()
    {
        $stub = new ItemTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Dictionary\Category\Translator\CategoryTranslator',
            $stub->getCategoryTranslatorPublic()
        );
    }

    public function testGetNullObject()
    {
        $stub = new ItemTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Dictionary\Item\Model\NullItem',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $item = array();
        $result = $this->stub->objectToArray($item);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(ItemTranslatorMock::class)
                           ->setMethods([
                               'getCategoryTranslator',
                               'statusFormatConversion'
                            ])->getMock();

        $item = MockObjectGenerate::generateItem(1);
        $category = $item->getCategory();
        $categoryArray = array('categoryArray');
        $status = $item->getStatus();
        $statusFormatConversion = array('statusFormatConversion');
        
        // 为 CategoryTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(CategoryTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray($category, ['id', 'name'])->shouldBeCalled(1)->willReturn($categoryArray);
        // 为 getCategoryTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getCategoryTranslator'
        )->willReturn($translator->reveal());
        
        $stub->expects($this->exactly(1))->method(
            'statusFormatConversion'
        )->with($status)->willReturn($statusFormatConversion);

        $result = $stub->objectToArray($item);

        $this->assertEquals($result['dictionaryCategory'], $categoryArray);
        $this->assertEquals($result['status'], $statusFormatConversion);

        $this->compareTranslatorEquals($result, $item);
    }
}
