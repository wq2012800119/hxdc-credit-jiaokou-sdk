<?php
namespace Sdk\Organization\Department\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Organization\Department\Utils\MockObjectGenerate;
use Sdk\Organization\Department\Utils\TranslatorUtilsTrait;

use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class DepartmentTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DepartmentTranslator();
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

    public function testGetOrganizationTranslator()
    {
        $stub = new DepartmentTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationTranslator',
            $stub->getOrganizationTranslatorPublic()
        );
    }

    public function testGetNullObject()
    {
        $stub = new DepartmentTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Organization\Department\Model\NullDepartment',
            $stub->getNullObjectPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $expression = array();
        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Organization\Department\Model\NullDepartment',
            $result
        );
    }

    public function testArrayToObject()
    {
        $stub = $this->getMockBuilder(DepartmentTranslatorMock::class)
                           ->setMethods([
                               'getOrganizationTranslator'
                            ])->getMock();

        $department = MockObjectGenerate::generateDepartment(1);
        $organizationArray = array('id' => $department->getOrganization()->getId());
        $organization = $department->getOrganization();

        // 为 OrganizationTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(OrganizationTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->arrayToObject($organizationArray)->shouldBeCalled(1)->willReturn($organization);
        // 为 getOrganizationTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getOrganizationTranslator'
        )->willReturn($translator->reveal());

        $expression['id'] = marmot_encode($department->getId());
        $expression['name'] = $department->getName();
        $expression['organization'] = $organizationArray;
        $expression['status'] = $department->getStatus();
        $expression['statusTime'] = $department->getStatusTime();
        $expression['createTime'] = $department->getCreateTime();
        $expression['updateTime'] = $department->getUpdateTime();

        $result = $stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Organization\Department\Model\Department',
            $result
        );

        $this->assertEquals($result->getOrganization(), $organization);
        $this->compareTranslatorEquals($expression, $result);
    }

    public function testObjectToArrayEmpty()
    {
        $department = array();
        $result = $this->stub->objectToArray($department);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(DepartmentTranslatorMock::class)
                           ->setMethods([
                               'getOrganizationTranslator'
                            ])->getMock();

        $department = MockObjectGenerate::generateDepartment(1);
        $organization = $department->getOrganization();
        $organizationArray = array('organizationArray');
    
        // 为 OrganizationTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(OrganizationTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray($organization, ['id', 'name'])->shouldBeCalled(1)->willReturn($organizationArray);
        // 为 getOrganizationTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getOrganizationTranslator'
        )->willReturn($translator->reveal());
        
        $result = $stub->objectToArray($department);

        $this->assertEquals($result['organization'], $organizationArray);
        $this->compareTranslatorEquals($result, $department);
    }
}
