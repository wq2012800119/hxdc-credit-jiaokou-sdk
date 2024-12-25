<?php
namespace Sdk\Resource\Directory\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Directory\Utils\MockObjectGenerate;
use Sdk\Resource\Directory\Utils\TranslatorUtilsTrait;

class TemplateRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new TemplateRestfulTranslator();
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

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\NullTemplate',
            $result
        );
    }

    public function testArrayToObject()
    {
        $template = MockObjectGenerate::generateTemplate(1);

        $expression['data']['id'] = $template->getId();
        $expression['data']['attributes']['name'] = $template->getName();
        $expression['data']['attributes']['path'] = $template->getPath();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\Template',
            $result
        );

        $this->compareTemplateRestfulTranslatorEquals($result, $expression);
    }

    public function testObjectToArrayEmpty()
    {
        $directory = array();
        $result = $this->stub->objectToArray($directory);

        $this->assertEmpty($result);
    }
}
