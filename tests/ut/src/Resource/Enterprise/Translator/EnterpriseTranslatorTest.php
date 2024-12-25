<?php
namespace Sdk\Resource\Enterprise\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Enterprise\Model\Enterprise;
use Sdk\Resource\Enterprise\Utils\MockObjectGenerate;
use Sdk\Resource\Enterprise\Utils\TranslatorUtilsTrait;

use Sdk\Resource\Data\Translator\DataTranslator;

class EnterpriseTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new EnterpriseTranslator();
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
        $stub = new EnterpriseTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Data\Translator\DataTranslator',
            $stub->getDataTranslatorPublic()
        );
    }

    public function testGetNullObject()
    {
        $stub = new EnterpriseTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Resource\Enterprise\Model\NullEnterprise',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $enterprise = array();
        $result = $this->stub->objectToArray($enterprise);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(EnterpriseTranslatorMock::class)
                           ->setMethods([
                               'idCardDataDesensitization',
                               'typeFormatConversion',
                               'statusFormatConversion',
                               'getDataTranslator'
                            ])->getMock();

        $enterprise = MockObjectGenerate::generateEnterprise(1);
        $enterprise->setZtlb(Enterprise::ZTLB['QYFR']);
        $enterprise->setHydm(Enterprise::HYDM['A']);
        $enterprise->setJyzt(Enterprise::JYZT['CXZYKYZC']);
        $enterprise->setAuthorization(Enterprise::AUTHORIZATION['UN_AUTHORIZE']);

        $sourceArray = $this->relationObjectToArray($enterprise, $stub);
        $authorizationArray = $this->statusFormatConversion($enterprise, $stub);
        $fddbrzjhmDesensitization = $this->fddbrzjhmDesensitization($enterprise, $stub);
        list($ztlbArray, $jyztArray) = $this->typeFormatConversion($enterprise, $stub);
 
        $result = $stub->objectToArray($enterprise);

        $this->assertEquals($result['jyzt'], $jyztArray);
        $this->assertEquals($result['ztlb'], $ztlbArray);
        $this->assertEquals($result['fddbrzjhmDesensitization'], $fddbrzjhmDesensitization);
        $this->assertEquals($result['authorization'], $authorizationArray);
        $this->assertEquals($result['source'], $sourceArray);
        
        $this->compareTranslatorEquals($result, $enterprise);
    }

    private function fddbrzjhmDesensitization(Enterprise $enterprise, $stub) : string
    {
        $fddbrzjhmDesensitization = '4128**********5763';

        $stub->expects($this->exactly(1))->method(
            'idCardDataDesensitization'
        )->with($enterprise->getFddbrzjhm())->willReturn($fddbrzjhmDesensitization);

        return $fddbrzjhmDesensitization;
    }

    private function typeFormatConversion(Enterprise $enterprise, $stub) : array
    {
        $ztlbArray = array('ztlb');
        $jyztArray = array('jyzt');

        $stub->expects($this->exactly(2))->method('typeFormatConversion')
            ->will($this->returnValueMap([
                [
                    $enterprise->getZtlb(), Enterprise::ZTLB_CN, $ztlbArray
                ],
                [
                    $enterprise->getJyzt(), Enterprise::JYZT_CN, $jyztArray
                ]
            ]));

        return [$ztlbArray, $jyztArray];
    }

    private function statusFormatConversion(Enterprise $enterprise, $stub) : array
    {
        $authorizationArray = array('authorization');

        $stub->expects($this->exactly(1))->method('statusFormatConversion')->with(
            $enterprise->getAuthorization(),
            Enterprise::AUTHORIZATION_TYPE,
            Enterprise::AUTHORIZATION_CN
        )->willReturn($authorizationArray);

        return $authorizationArray;
    }

    private function relationObjectToArray(Enterprise $enterprise, $stub) : array
    {
        $source = $enterprise->getSource();
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
