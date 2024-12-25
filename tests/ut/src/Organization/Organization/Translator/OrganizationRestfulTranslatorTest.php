<?php
namespace Sdk\Organization\Organization\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Organization\Organization\Utils\MockObjectGenerate;
use Sdk\Organization\Organization\Utils\TranslatorUtilsTrait;

use Sdk\Dictionary\Item\Translator\ItemRestfulTranslator;
use Sdk\Dictionary\Item\Utils\MockObjectGenerate as ItemMockObjectGenerate;

class OrganizationRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new OrganizationRestfulTranslator();
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

    public function testGetItemRestfulTranslator()
    {
        $stub = new OrganizationRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Dictionary\Item\Translator\ItemRestfulTranslator',
            $stub->getItemRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\NullOrganization',
            $result
        );
    }

    public function testArrayToObject()
    {
        $organization = MockObjectGenerate::generateOrganization(1);

        $expression['data']['id'] = $organization->getId();
        $expression['data']['attributes']['name'] = $organization->getName();
        $expression['data']['attributes']['shortName'] = $organization->getShortName();
        $expression['data']['attributes']['unifiedIdentifier'] = $organization->getUnifiedIdentifier();
        $expression['data']['attributes']['status'] = $organization->getStatus();
        $expression['data']['attributes']['statusTime'] = $organization->getStatusTime();
        $expression['data']['attributes']['createTime'] = $organization->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $organization->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\Organization',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $stub = $this->getMockBuilder(OrganizationRestfulTranslatorMock::class)
                           ->setMethods([
                               'includedFormatConversion',
                               'relationshipFill',
                               'getItemRestfulTranslator'
                            ])->getMock();

        $relationships = array(
            'jurisdictionArea' => array('jurisdictionArea')
        );
        $included = array('included');
        $expression['data']['relationships'] = $relationships;
        $expression['included'] = $included;

        $includedConversion = array('includedConversion');
        $jurisdictionAreaArray = array('jurisdictionAreaArray');
        $jurisdictionArea = ItemMockObjectGenerate::generateItem(1);

        $stub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);

        $stub->expects($this->exactly(1))->method(
            'relationshipFill'
        )->with($relationships['jurisdictionArea'], $includedConversion)->willReturn($jurisdictionAreaArray);

        // 为 ItemRestfulTranslator 类建立预言(prophecy)。
        $restfulTranslator = $this->prophesize(ItemRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $restfulTranslator->arrayToObject($jurisdictionAreaArray)->shouldBeCalled(1)->willReturn($jurisdictionArea);
        // 为 getItemRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getItemRestfulTranslator'
        )->willReturn($restfulTranslator->reveal());

        $result = $stub->arrayToObject($expression);
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\Organization',
            $result
        );

        $this->assertEquals($jurisdictionArea, $result->getJurisdictionArea());
    }

    public function testObjectToArrayEmpty()
    {
        $organization = array();
        $result = $this->stub->objectToArray($organization);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $organization = MockObjectGenerate::generateOrganization(1);

        $result = $this->stub->objectToArray($organization);
        $this->compareRestfulTranslatorEquals($organization, $result);
    }
}
