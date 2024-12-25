<?php
namespace Sdk\Article\Category\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Article\Category\Model\Category;
use Sdk\Article\Category\Utils\MockObjectGenerate;
use Sdk\Article\Category\Utils\TranslatorUtilsTrait;

class CategoryTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new CategoryTranslator();
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

    public function testGetNullObject()
    {
        $stub = new CategoryTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Article\Category\Model\NullCategory',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $category = array();
        $result = $this->stub->objectToArray($category);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(CategoryTranslatorMock::class)
                           ->setMethods([
                               'typeFormatConversion',
                               'diyContentFormatConversion'
                            ])->getMock();

        $category = MockObjectGenerate::generateCategory(1);
        $levelArray = array('level');
        $styleArray = array('style');
        $diyContentArray = array('diyContent');

        $stub->expects($this->exactly(2))->method('typeFormatConversion')
            ->will($this->returnValueMap([
                [
                    $category->getLevel(), Category::LEVEL_CN, $levelArray
                ],
                [
                    $category->getStyle(), Category::STYLE_CN, $styleArray
                ]
            ]));

        $stub->expects($this->exactly(1))->method('diyContentFormatConversion')->with(
            $category->getDiyContent()
        )->willReturn($diyContentArray);

        $result = $stub->objectToArray($category);

        $this->assertEquals($result['style'], $styleArray);
        $this->assertEquals($result['level'], $levelArray);
        $this->assertEquals($result['diyContent'], $diyContentArray);
        $this->compareTranslatorEquals($result, $category);
    }

    public function testDiyContentFormatConversion()
    {
        $stub = new CategoryTranslatorMock();
        $diyContent = array(
            'slidesPictureDisplayStatus' => 1,
            'rightToolbarDisplayStatus' => 1,
            'childrenCategories' => array(
                array('category' => 1, 'status' => 1),
                array('category' => 1, 'status' => 1)
            )
        );

        $result = $stub->diyContentFormatConversionPublic($diyContent);

        $this->assertIsArray($result);
    }
}
