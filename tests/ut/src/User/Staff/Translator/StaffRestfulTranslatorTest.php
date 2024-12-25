<?php
namespace Sdk\User\Staff\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\User\Staff\Utils\MockObjectGenerate;
use Sdk\User\Staff\Utils\TranslatorUtilsTrait;

use Sdk\Role\Translator\RoleRestfulTranslator;
use Sdk\Role\Utils\MockObjectGenerate as RoleMockObjectGenerate;

use Sdk\Organization\Department\Translator\DepartmentRestfulTranslator;
use Sdk\Organization\Department\Utils\MockObjectGenerate as DepartmentMockObjectGenerate;

use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;
use Sdk\Organization\Organization\Utils\MockObjectGenerate as OrganizationMockObjectGenerate;

class StaffRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new StaffRestfulTranslator();
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

    public function testGetRoleRestfulTranslator()
    {
        $stub = new StaffRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Role\Translator\RoleRestfulTranslator',
            $stub->getRoleRestfulTranslatorPublic()
        );
    }

    public function testGetDepartmentRestfulTranslator()
    {
        $stub = new StaffRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Department\Translator\DepartmentRestfulTranslator',
            $stub->getDepartmentRestfulTranslatorPublic()
        );
    }

    public function testGetOrganizationRestfulTranslator()
    {
        $stub = new StaffRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator',
            $stub->getOrganizationRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\NullStaff',
            $result
        );
    }

    public function testArrayToObject()
    {
        $staff = MockObjectGenerate::generateStaff(1);

        $expression['data']['id'] = $staff->getId();
        $expression['data']['attributes']['subjectName'] = $staff->getSubjectName();
        $expression['data']['attributes']['cellphone'] = $staff->getCellphone();
        $expression['data']['attributes']['idCard'] = $staff->getIdCard();
        $expression['data']['attributes']['password'] = $staff->getPassword();
        $expression['data']['attributes']['category'] = $staff->getCategory();
        $expression['data']['attributes']['purview'] = $staff->getPurview();
        $expression['data']['attributes']['status'] = $staff->getStatus();
        $expression['data']['attributes']['statusTime'] = $staff->getStatusTime();
        $expression['data']['attributes']['createTime'] = $staff->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $staff->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\Staff',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $stub = $this->getMockBuilder(StaffRestfulTranslatorMock::class)
                           ->setMethods([
                               'includedFormatConversion',
                               'relationshipFill',
                               'getDepartmentRestfulTranslator',
                               'getOrganizationRestfulTranslator',
                               'getRoleRestfulTranslator'
                            ])->getMock();

        $relationships = array(
            'department' => array('department'),
            'roles' => array('data'=> array(
                array('role')
            )),
            'organization' => array('organization')
        );
        $included = array('included');
        $expression['data']['relationships'] = $relationships;
        $expression['included'] = $included;
        $includedConversion = array('includedConversion');

        $organizationArray = array('organizationArray');
        $organization = OrganizationMockObjectGenerate::generateOrganization(1);
        $departmentArray = array('departmentArray');
        $department = DepartmentMockObjectGenerate::generateDepartment(1);
        $roleArray = array('roleArray');
        $role = RoleMockObjectGenerate::generateRole(1);

        $relationshipsRole = array('data' => array('role'));

        $stub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);
        
        $stub->expects($this->exactly(3))->method('relationshipFill')
            ->will($this->returnValueMap([
                [
                    $relationships['organization'], $includedConversion, $organizationArray
                ],
                [
                    $relationships['department'], $includedConversion, $departmentArray
                ],
                [
                    $relationshipsRole, $includedConversion, $roleArray
                ]
            ]));

        // 为 OrganizationRestfulTranslator 类建立预言(prophecy)。
        $organizationRestfulTranslator = $this->prophesize(OrganizationRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $organizationRestfulTranslator->arrayToObject(
            $organizationArray
        )->shouldBeCalled(1)->willReturn($organization);
        // 为 getOrganizationRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getOrganizationRestfulTranslator'
        )->willReturn($organizationRestfulTranslator->reveal());

        // 为 DepartmentRestfulTranslator 类建立预言(prophecy)。
        $departmentRestfulTranslator = $this->prophesize(DepartmentRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $departmentRestfulTranslator->arrayToObject(
            $departmentArray
        )->shouldBeCalled(1)->willReturn($department);
        // 为 getDepartmentRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getDepartmentRestfulTranslator'
        )->willReturn($departmentRestfulTranslator->reveal());

        // 为 RoleRestfulTranslator 类建立预言(prophecy)。
        $roleRestfulTranslator = $this->prophesize(RoleRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $roleRestfulTranslator->arrayToObject(
            $roleArray
        )->shouldBeCalled(1)->willReturn($role);
        // 为 getRoleRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getRoleRestfulTranslator'
        )->willReturn($roleRestfulTranslator->reveal());

        $result = $stub->arrayToObject($expression);
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\Staff',
            $result
        );

        $this->assertEquals($organization, $result->getOrganization());
        $this->assertEquals($department, $result->getDepartment());
        $this->assertEquals([$role], $result->getRoles());
    }

    public function testObjectToArrayEmpty()
    {
        $staff = array();
        $result = $this->stub->objectToArray($staff);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $staff = MockObjectGenerate::generateStaff(1);

        $result = $this->stub->objectToArray($staff);
        $this->compareRestfulTranslatorEquals($staff, $result);
    }
}
