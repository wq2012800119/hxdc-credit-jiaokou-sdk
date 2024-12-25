<?php
namespace Sdk\Dictionary\Category\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Dictionary\Category\Utils\MockObjectGenerate;
use Sdk\Dictionary\Category\Utils\TranslatorUtilsTrait;

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
            'Sdk\Dictionary\Category\Model\NullCategory',
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
        $category = MockObjectGenerate::generateCategory(1);

        $result = $this->stub->objectToArray($category);

        $this->compareTranslatorEquals($result, $category);
    }
}
