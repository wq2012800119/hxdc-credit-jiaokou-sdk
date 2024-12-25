<?php
namespace Sdk\Resource\Directory\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Directory\Utils\MockObjectGenerate;
use Sdk\Resource\Directory\Utils\TranslatorUtilsTrait;

class TemplateTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new TemplateTranslator();
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
        $stub = new TemplateTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\NullTemplate',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $template = array();

        $result = $this->stub->objectToArray($template);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $template = MockObjectGenerate::generateTemplate(1);

        $result = $this->stub->objectToArray($template);
        $this->compareTemplateTranslatorEquals($result, $template);
    }
}
