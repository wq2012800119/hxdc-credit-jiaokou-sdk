<?php
namespace Sdk\Resource\NaturalPerson\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\NaturalPerson\Utils\MockObjectGenerate;
use Sdk\Resource\NaturalPerson\Utils\TranslatorUtilsTrait;

use Sdk\Resource\Data\Translator\DataRestfulTranslator;
use Sdk\Resource\Data\Utils\MockObjectGenerate as DataMockObjectGenerate;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class NaturalPersonRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new NaturalPersonRestfulTranslator();
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

    public function testGetDataRestfulTranslator()
    {
        $stub = new NaturalPersonRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Data\Translator\DataRestfulTranslator',
            $stub->getDataRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Resource\NaturalPerson\Model\NullNaturalPerson',
            $result
        );
    }

    public function testArrayToObject()
    {
        $naturalPerson = MockObjectGenerate::generateNaturalPerson(1);

        $expression['data']['id'] = $naturalPerson->getId();
        $expression['data']['attributes']['ztmc'] = $naturalPerson->getZtmc();
        $expression['data']['attributes']['cym'] = $naturalPerson->getCym();
        $expression['data']['attributes']['zjhm'] = $naturalPerson->getZjhm();
        $expression['data']['attributes']['xb'] = $naturalPerson->getXb();
        $expression['data']['attributes']['csrq'] = $naturalPerson->getCsrq();
        $expression['data']['attributes']['cssj'] = $naturalPerson->getCssj();
        $expression['data']['attributes']['csdgj'] = $naturalPerson->getCsdgj();
        $expression['data']['attributes']['csdssx'] = $naturalPerson->getCsdssx();
        $expression['data']['attributes']['jggj'] = $naturalPerson->getJggj();
        $expression['data']['attributes']['jgssx'] = $naturalPerson->getJgssx();
        $expression['data']['attributes']['swrq'] = $naturalPerson->getSwrq();
        $expression['data']['attributes']['qcrq'] = $naturalPerson->getQcrq();
        $expression['data']['attributes']['hb'] = $naturalPerson->getHb();
        $expression['data']['attributes']['hh'] = $naturalPerson->getHh();
        $expression['data']['attributes']['yhzgx'] = $naturalPerson->getYhzgx();
        $expression['data']['attributes']['ryzt'] = $naturalPerson->getRyzt();
        $expression['data']['attributes']['pcs'] = $naturalPerson->getPcs();
        $expression['data']['attributes']['jlx'] = $naturalPerson->getJlx();
        $expression['data']['attributes']['mlph'] = $naturalPerson->getMlph();
        $expression['data']['attributes']['mlxz'] = $naturalPerson->getMlxz();
        $expression['data']['attributes']['xzjd'] = $naturalPerson->getXzjd();
        $expression['data']['attributes']['jcwh'] = $naturalPerson->getJcwh();
        $expression['data']['attributes']['mz'] = $naturalPerson->getMz();
        $expression['data']['attributes']['authorization'] = $naturalPerson->getAuthorization();
        $expression['data']['attributes']['status'] = $naturalPerson->getStatus();
        $expression['data']['attributes']['statusTime'] = $naturalPerson->getStatusTime();
        $expression['data']['attributes']['createTime'] = $naturalPerson->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $naturalPerson->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf('Sdk\Resource\NaturalPerson\Model\NaturalPerson', $result);
        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $naturalPersonStub = $this->getMockBuilder(NaturalPersonRestfulTranslatorMock::class)
                           ->setMethods([
                               'includedFormatConversion',
                               'relationshipFill',
                               'getDataRestfulTranslator'
                            ])->getMock();

        $relationships = array('source' => array('source'));
        $included = array('included');
        $expression['data']['relationships'] = $relationships;
        $expression['included'] = $included;
        $includedConversion = array('includedConversion');
    
        $sourceArray = array('sourceArray');
        $source = DataMockObjectGenerate::generateData(1);

        $naturalPersonStub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);

        $naturalPersonStub->expects($this->exactly(1))->method(
            'relationshipFill'
        )->with($relationships['source'], $includedConversion)->willReturn($sourceArray);

        // 为 DataRestfulTranslator 类建立预言(prophecy)。
        $sourceRestfulTranslator = $this->prophesize(DataRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $sourceRestfulTranslator->arrayToObject($sourceArray)->shouldBeCalled(1)->willReturn($source);
        // 为 getDataRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $naturalPersonStub->expects($this->exactly(1))->method(
            'getDataRestfulTranslator'
        )->willReturn($sourceRestfulTranslator->reveal());

        $result = $naturalPersonStub->arrayToObject($expression);
        $this->assertInstanceOf('Sdk\Resource\NaturalPerson\Model\NaturalPerson', $result);

        $this->assertEquals($source, $result->getSource());
    }

    public function testObjectToArray()
    {
        $naturalPerson = array();
        $result = $this->stub->objectToArray($naturalPerson);

        $this->assertEmpty($result);
    }
}
