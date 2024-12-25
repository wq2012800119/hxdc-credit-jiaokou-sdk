<?php
namespace Sdk\Resource\Enterprise\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Enterprise\Utils\MockObjectGenerate;
use Sdk\Resource\Enterprise\Utils\TranslatorUtilsTrait;

use Sdk\Resource\Data\Translator\DataRestfulTranslator;
use Sdk\Resource\Data\Utils\MockObjectGenerate as DataMockObjectGenerate;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class EnterpriseRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new EnterpriseRestfulTranslator();
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
        $stub = new EnterpriseRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Data\Translator\DataRestfulTranslator',
            $stub->getDataRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Resource\Enterprise\Model\NullEnterprise',
            $result
        );
    }

    public function testArrayToObject()
    {
        $enterprise = MockObjectGenerate::generateEnterprise(1);

        $expression['data']['id'] = $enterprise->getId();
        $expression['data']['attributes']['ztmc'] = $enterprise->getZtmc();
        $expression['data']['attributes']['ztlb'] = $enterprise->getZtlb();
        $expression['data']['attributes']['tyshxydm'] = $enterprise->getTyshxydm();
        $expression['data']['attributes']['fddbr'] = $enterprise->getFddbr();
        $expression['data']['attributes']['fddbrzjlx'] = $enterprise->getFddbrzjlx();
        $expression['data']['attributes']['fddbrzjhm'] = $enterprise->getFddbrzjhm();
        $expression['data']['attributes']['clrq'] = $enterprise->getClrq();
        $expression['data']['attributes']['yxq'] = $enterprise->getYxq();
        $expression['data']['attributes']['dz'] = $enterprise->getDz();
        $expression['data']['attributes']['djjg'] = $enterprise->getDjjg();
        $expression['data']['attributes']['gb'] = $enterprise->getGb();
        $expression['data']['attributes']['zczb'] = $enterprise->getZczb();
        $expression['data']['attributes']['zczbbz'] = $enterprise->getZczbbz();
        $expression['data']['attributes']['hydm'] = $enterprise->getHydm();
        $expression['data']['attributes']['lx'] = $enterprise->getLx();
        $expression['data']['attributes']['jyfw'] = $enterprise->getJyfw();
        $expression['data']['attributes']['jyzt'] = $enterprise->getJyzt();
        $expression['data']['attributes']['jyfwms'] = $enterprise->getJyfwms();
        $expression['data']['attributes']['authorization'] = $enterprise->getAuthorization();
        $expression['data']['attributes']['status'] = $enterprise->getStatus();
        $expression['data']['attributes']['statusTime'] = $enterprise->getStatusTime();
        $expression['data']['attributes']['createTime'] = $enterprise->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $enterprise->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf('Sdk\Resource\Enterprise\Model\Enterprise', $result);
        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $stub = $this->getMockBuilder(EnterpriseRestfulTranslatorMock::class)
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

        $stub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);

        $stub->expects($this->exactly(1))->method(
            'relationshipFill'
        )->with($relationships['source'], $includedConversion)->willReturn($sourceArray);

        // 为 DataRestfulTranslator 类建立预言(prophecy)。
        $sourceRestfulTranslator = $this->prophesize(DataRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $sourceRestfulTranslator->arrayToObject($sourceArray)->shouldBeCalled(1)->willReturn($source);
        // 为 getDataRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getDataRestfulTranslator'
        )->willReturn($sourceRestfulTranslator->reveal());

        $result = $stub->arrayToObject($expression);
        $this->assertInstanceOf('Sdk\Resource\Enterprise\Model\Enterprise', $result);

        $this->assertEquals($source, $result->getSource());
    }

    public function testObjectToArray()
    {
        $enterprise = array();
        $result = $this->stub->objectToArray($enterprise);

        $this->assertEmpty($result);
    }
}
