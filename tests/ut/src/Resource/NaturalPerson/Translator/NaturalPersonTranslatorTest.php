<?php
namespace Sdk\Resource\NaturalPerson\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\NaturalPerson\Model\NaturalPerson;
use Sdk\Resource\NaturalPerson\Utils\MockObjectGenerate;
use Sdk\Resource\NaturalPerson\Utils\TranslatorUtilsTrait;

use Sdk\Resource\Data\Translator\DataTranslator;

class NaturalPersonTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new NaturalPersonTranslator();
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

    public function testGetDataTranslator()
    {
        $stub = new NaturalPersonTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Data\Translator\DataTranslator',
            $stub->getDataTranslatorPublic()
        );
    }

    public function testGetNullObject()
    {
        $stub = new NaturalPersonTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Resource\NaturalPerson\Model\NullNaturalPerson',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $naturalPerson = array();
        $result = $this->stub->objectToArray($naturalPerson);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(NaturalPersonTranslatorMock::class)
                           ->setMethods([
                               'idCardDataDesensitization',
                               'statusFormatConversion',
                               'getDataTranslator'
                            ])->getMock();

        $naturalPerson = MockObjectGenerate::generateNaturalPerson(1);
        $naturalPerson->setAuthorization(NaturalPerson::AUTHORIZATION['UN_AUTHORIZE']);

        $sourceArray = $this->relationObjectToArray($naturalPerson, $stub);
        $authorizationArray = $this->statusFormatConversion($naturalPerson, $stub);
        $zjhmDesensitization = $this->zjhmDesensitization($naturalPerson, $stub);
 
        $result = $stub->objectToArray($naturalPerson);

        $this->assertEquals($result['zjhmDesensitization'], $zjhmDesensitization);
        $this->assertEquals($result['authorization'], $authorizationArray);
        $this->assertEquals($result['source'], $sourceArray);
        
        $this->compareTranslatorEquals($result, $naturalPerson);
    }

    private function zjhmDesensitization(NaturalPerson $naturalPerson, $stub) : string
    {
        $zjhmDesensitization = '4128**********5763';

        $stub->expects($this->exactly(1))->method(
            'idCardDataDesensitization'
        )->with($naturalPerson->getZjhm())->willReturn($zjhmDesensitization);

        return $zjhmDesensitization;
    }

    private function statusFormatConversion(NaturalPerson $naturalPerson, $stub) : array
    {
        $authorizationArray = array('authorization');

        $stub->expects($this->exactly(1))->method('statusFormatConversion')->with(
            $naturalPerson->getAuthorization(),
            NaturalPerson::AUTHORIZATION_TYPE,
            NaturalPerson::AUTHORIZATION_CN
        )->willReturn($authorizationArray);

        return $authorizationArray;
    }

    private function relationObjectToArray(NaturalPerson $naturalPerson, $stub) : array
    {
        $source = $naturalPerson->getSource();
        $sourceArray = array('sourceArray');

        // 为 DataTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(DataTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $source,
            ['id', 'subjectName']
        )->shouldBeCalled(1)->willReturn($sourceArray);
        // 为 getDataTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getDataTranslator'
        )->willReturn($translator->reveal());

        return $sourceArray;
    }
}
