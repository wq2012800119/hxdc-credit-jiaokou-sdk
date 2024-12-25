<?php
namespace Sdk\Organization\Organization\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Organization\Organization\Utils\MockObjectGenerate;
use Sdk\Organization\Organization\Utils\TranslatorUtilsTrait;

use Sdk\Dictionary\Item\Translator\ItemTranslator;

class OrganizationTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new OrganizationTranslator();
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

    public function testGetItemTranslator()
    {
        $stub = new OrganizationTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Dictionary\Item\Translator\ItemTranslator',
            $stub->getItemTranslatorPublic()
        );
    }

    public function testGetNullObject()
    {
        $stub = new OrganizationTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\NullOrganization',
            $stub->getNullObjectPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $expression = array();
        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\NullOrganization',
            $result
        );
    }

    public function testArrayToObject()
    {
        $organization = MockObjectGenerate::generateOrganization(1);

        $expression['id'] = marmot_encode($organization->getId());
        $expression['name'] = $organization->getName();
        $expression['shortName'] = $organization->getShortName();
        $expression['unifiedIdentifier'] = $organization->getUnifiedIdentifier();
        $expression['status'] = $organization->getStatus();
        $expression['statusTime'] = $organization->getStatusTime();
        $expression['createTime'] = $organization->getCreateTime();
        $expression['updateTime'] = $organization->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\Organization',
            $result
        );

        $this->compareTranslatorEquals($expression, $result);
    }

    public function testObjectToArrayEmpty()
    {
        $organization = array();
        $result = $this->stub->objectToArray($organization);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(OrganizationTranslatorMock::class)
                           ->setMethods([
                               'getItemTranslator'
                            ])->getMock();

        $organization = MockObjectGenerate::generateOrganization(1);
        $jurisdictionArea = $organization->getJurisdictionArea();
        $jurisdictionAreaArray = array('jurisdictionAreaArray');
    
        // 为 ItemTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(ItemTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $jurisdictionArea,
            ['id', 'name']
        )->shouldBeCalled(1)->willReturn($jurisdictionAreaArray);
        // 为 getItemTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getItemTranslator'
        )->willReturn($translator->reveal());
        
        $result = $stub->objectToArray($organization);

        $this->assertEquals($result['jurisdictionArea'], $jurisdictionAreaArray);
        $this->compareTranslatorEquals($result, $organization);
    }
}
