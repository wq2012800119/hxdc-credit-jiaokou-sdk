<?php
namespace Sdk\Organization\Department\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Organization\Department\Utils\MockObjectGenerate;
use Sdk\Organization\Department\Utils\TranslatorUtilsTrait;

use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;
use Sdk\Organization\Organization\Utils\MockObjectGenerate as OrganizationMockObjectGenerate;

class DepartmentRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DepartmentRestfulTranslator();
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

    public function testGetOrganizationRestfulTranslator()
    {
        $stub = new DepartmentRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator',
            $stub->getOrganizationRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Organization\Department\Model\NullDepartment',
            $result
        );
    }

    public function testArrayToObject()
    {
        $department = MockObjectGenerate::generateDepartment(1);

        $expression['data']['id'] = $department->getId();
        $expression['data']['attributes']['name'] = $department->getName();
        $expression['data']['attributes']['status'] = $department->getStatus();
        $expression['data']['attributes']['statusTime'] = $department->getStatusTime();
        $expression['data']['attributes']['createTime'] = $department->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $department->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Organization\Department\Model\Department',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $stub = $this->getMockBuilder(DepartmentRestfulTranslatorMock::class)
                           ->setMethods([
                               'includedFormatConversion',
                               'relationshipFill',
                               'getOrganizationRestfulTranslator'
                            ])->getMock();

        $relationships = array(
            'organization' => array('organization')
        );
        $included = array('included');
        $expression['data']['relationships'] = $relationships;
        $expression['included'] = $included;

        $includedConversion = array('includedConversion');
        $organizationArray = array('organizationArray');
        $organization = OrganizationMockObjectGenerate::generateOrganization(1);

        $stub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);

        $stub->expects($this->exactly(1))->method(
            'relationshipFill'
        )->with($relationships['organization'], $includedConversion)->willReturn($organizationArray);

        // 为 OrganizationRestfulTranslator 类建立预言(prophecy)。
        $restfulTranslator = $this->prophesize(OrganizationRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $restfulTranslator->arrayToObject($organizationArray)->shouldBeCalled(1)->willReturn($organization);
        // 为 getOrganizationRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getOrganizationRestfulTranslator'
        )->willReturn($restfulTranslator->reveal());

        $result = $stub->arrayToObject($expression);
        $this->assertInstanceOf(
            'Sdk\Organization\Department\Model\Department',
            $result
        );

        $this->assertEquals($organization, $result->getOrganization());
    }

    public function testObjectToArrayEmpty()
    {
        $department = array();
        $result = $this->stub->objectToArray($department);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $department = MockObjectGenerate::generateDepartment(1);

        $result = $this->stub->objectToArray($department);
        $this->compareRestfulTranslatorEquals($department, $result);
    }
}
