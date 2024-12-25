<?php
namespace Sdk\Dictionary\Category\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Dictionary\Category\Utils\MockObjectGenerate;
use Sdk\Dictionary\Category\Utils\TranslatorUtilsTrait;

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

    public function testObjectToArray()
    {
        $category = MockObjectGenerate::generateCategory(1);
        $result = $this->stub->objectToArray($category);

        $this->assertEmpty($result);
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Dictionary\Category\Model\NullCategory',
            $result
        );
    }

    public function testArrayToObject()
    {
        $category = MockObjectGenerate::generateCategory(1);

        $expression['data']['id'] = $category->getId();
        $expression['data']['attributes']['name'] = $category->getName();
        $expression['data']['attributes']['status'] = $category->getStatus();
        $expression['data']['attributes']['statusTime'] = $category->getStatusTime();
        $expression['data']['attributes']['createTime'] = $category->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $category->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Dictionary\Category\Model\Category',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }
}
