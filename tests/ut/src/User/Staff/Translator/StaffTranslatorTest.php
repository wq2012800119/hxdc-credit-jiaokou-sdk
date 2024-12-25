<?php
namespace Sdk\User\Staff\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\Interfaces\ITopAble;
use Sdk\Common\Model\Interfaces\IExamineAble;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Utils\MockObjectGenerate;
use Sdk\User\Staff\Utils\TranslatorUtilsTrait;

use Sdk\Role\Translator\RoleTranslator;
use Sdk\Organization\Department\Translator\DepartmentTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class StaffTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new StaffTranslator();
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

    public function testGetRoleTranslator()
    {
        $stub = new StaffTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Role\Translator\RoleTranslator',
            $stub->getRoleTranslatorPublic()
        );
    }

    public function testGetDepartmentTranslator()
    {
        $stub = new StaffTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Department\Translator\DepartmentTranslator',
            $stub->getDepartmentTranslatorPublic()
        );
    }

    public function testGetOrganizationTranslator()
    {
        $stub = new StaffTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationTranslator',
            $stub->getOrganizationTranslatorPublic()
        );
    }

    public function testGetNullObject()
    {
        $stub = new StaffTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\NullStaff',
            $stub->getNullObjectPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $expression = array();
        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\NullStaff',
            $result
        );
    }

    public function testArrayToObject()
    {
        $stub = $this->getMockBuilder(StaffTranslatorMock::class)
                           ->setMethods([
                               'purviewFormatConversionToObject',
                               'getOrganizationTranslator',
                               'getDepartmentTranslator',
                               'getRoleTranslator'
                            ])->getMock();

        $staff = MockObjectGenerate::generateStaff(1);
        $organizationArray = $this->arrayToObjectOrganization($staff, $stub);
        $departmentArray = $this->arrayToObjectDepartment($staff, $stub);
        $rolesArray = $this->arrayToObjectRoles($staff, $stub);

        $purview = $staff->getPurview();
        $purviewFormatConversion = array('purviewFormatConversion');
        $stub->expects($this->exactly(1))->method(
            'purviewFormatConversionToObject'
        )->with($purviewFormatConversion)->willReturn($purview);

        $expression['id'] = marmot_encode($staff->getId());
        $expression['subjectName'] = $staff->getSubjectName();
        $expression['cellphone'] = $staff->getCellphone();
        $expression['idCard'] = $staff->getIdCard();
        $expression['identification'] = $staff->getIdentification();
        $expression['category']['id'] = marmot_encode($staff->getCategory());
        $expression['subjectName'] = $staff->getSubjectName();
        $expression['purview'] = $purviewFormatConversion;
        $expression['organization'] = $organizationArray;
        $expression['department'] = $departmentArray;
        $expression['roles'] = $rolesArray;
        $expression['status']['id'] = marmot_encode($staff->getStatus());
        $expression['statusTime'] = $staff->getStatusTime();
        $expression['createTime'] = $staff->getCreateTime();
        $expression['updateTime'] = $staff->getUpdateTime();

        $result = $stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\Staff',
            $result
        );

        $this->assertEquals($result->getPurview(), $purview);
        $this->assertEquals($result->getOrganization(), $staff->getOrganization());
        $this->assertEquals($result->getDepartment(), $staff->getDepartment());
        $this->assertEquals($result->getRoles(), $staff->getRoles());
        $this->compareTranslatorEquals($expression, $result);
    }

    private function arrayToObjectOrganization(Staff $staff, $stub)
    {
        $organizationArray = array('id' => $staff->getOrganization()->getId());
        $organization = $staff->getOrganization();

        // 为 OrganizationTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(OrganizationTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->arrayToObject($organizationArray)->shouldBeCalled(1)->willReturn($organization);
        // 为 getOrganizationTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getOrganizationTranslator'
        )->willReturn($translator->reveal());

        return $organizationArray;
    }

    private function arrayToObjectDepartment(Staff $staff, $stub)
    {
        $departmentArray = array('id' => $staff->getDepartment()->getId());
        $department = $staff->getDepartment();

        // 为 DepartmentTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(DepartmentTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->arrayToObject($departmentArray)->shouldBeCalled(1)->willReturn($department);
        // 为 getDepartmentTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getDepartmentTranslator'
        )->willReturn($translator->reveal());

        return $departmentArray;
    }

    private function arrayToObjectRoles(Staff $staff, $stub)
    {
        $role = current($staff->getRoles());
        $roleArray = array('id' => $role->getId());

        // 为 RoleTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(RoleTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->arrayToObject($roleArray)->shouldBeCalled(1)->willReturn($role);
        // 为 getRoleTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getRoleTranslator'
        )->willReturn($translator->reveal());

        return [$roleArray];
    }

    public function testObjectToArrayEmpty()
    {
        $staff = array();
        $result = $this->stub->objectToArray($staff);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(StaffTranslatorMock::class)
                           ->setMethods([
                               'typeFormatConversion',
                               'purviewFormatConversionToArray',
                               'getOrganizationTranslator',
                               'getDepartmentTranslator',
                               'getRoleTranslator',
                               'statusFormatConversion',
                               'idCardDataDesensitization',
                               'cellphoneDataDesensitization'
                            ])->getMock();

        $staff = MockObjectGenerate::generateStaff(1);
        list(
            $organizationArray,
            $departmentArray,
            $rolesArray
        ) = $this->relationObjectToArray($staff, $stub);

        $categoryArray = $this->typeFormatConversion($staff, $stub);
        $statusArray = $this->statusFormatConversion($staff, $stub);
        $idCardDesensitization = $this->idCardDataDesensitization($staff, $stub);
        $cellphoneDesensitization = $this->cellphoneDataDesensitization($staff, $stub);
        
        $result = $stub->objectToArray($staff);

        $this->assertEquals($result['category'], $categoryArray);
        $this->assertEquals($result['status'], $statusArray);
        $this->assertEquals($result['organization'], $organizationArray);
        $this->assertEquals($result['department'], $departmentArray);
        $this->assertEquals($result['roles'], $rolesArray);
        $this->assertEquals($result['idCardDesensitization'], $idCardDesensitization);
        $this->assertEquals($result['cellphoneDesensitization'], $cellphoneDesensitization);
        
        $this->compareTranslatorEquals($result, $staff);
    }

    private function cellphoneDataDesensitization(Staff $staff, $stub) : string
    {
        $cellphoneDesensitization = '137****3456';

        $stub->expects($this->exactly(1))->method(
            'cellphoneDataDesensitization'
        )->with($staff->getCellphone())->willReturn($cellphoneDesensitization);

        return $cellphoneDesensitization;
    }

    private function idCardDataDesensitization(Staff $staff, $stub) : string
    {
        $idCardDesensitization = '4128**********5763';

        $stub->expects($this->exactly(1))->method(
            'idCardDataDesensitization'
        )->with($staff->getIdCard())->willReturn($idCardDesensitization);

        return $idCardDesensitization;
    }

    private function typeFormatConversion(Staff $staff, $stub) : array
    {
        $categoryArray = array('category');

        $stub->expects($this->exactly(1))->method(
            'typeFormatConversion'
        )->with($staff->getCategory(), Staff::CATEGORY_CN)->willReturn($categoryArray);

        return $categoryArray;
    }

    private function statusFormatConversion(Staff $staff, $stub) : array
    {
        $statusArray = array('status');

        $stub->expects($this->exactly(1))->method(
            'statusFormatConversion'
        )->with($staff->getStatus())->willReturn($statusArray);

        return $statusArray;
    }

    private function relationObjectToArray(Staff $staff, $stub) : array
    {
        $organizationArray = $this->organizationRelationObjectToArray($staff, $stub);
        $departmentArray = $this->departmentRelationObjectToArray($staff, $stub);
        $rolesArray = $this->rolesRelationObjectToArray($staff, $stub);

        return [$organizationArray, $departmentArray, $rolesArray];
    }

    private function organizationRelationObjectToArray(Staff $staff, $stub) : array
    {
        $organization = $staff->getOrganization();
        $organizationArray = array('organizationArray');

        // 为 OrganizationTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(OrganizationTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $organization,
            ['id', 'name']
        )->shouldBeCalled(1)->willReturn($organizationArray);
        // 为 getOrganizationTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getOrganizationTranslator'
        )->willReturn($translator->reveal());

        return $organizationArray;
    }

    private function departmentRelationObjectToArray(Staff $staff, $stub) : array
    {
        $department = $staff->getDepartment();
        $departmentArray = array('departmentArray');

        // 为 DepartmentTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(DepartmentTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $department,
            ['id', 'name']
        )->shouldBeCalled(1)->willReturn($departmentArray);
        // 为 getDepartmentTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getDepartmentTranslator'
        )->willReturn($translator->reveal());

        return $departmentArray;
    }

    private function rolesRelationObjectToArray(Staff $staff, $stub) : array
    {
        $role = current($staff->getRoles());
        $roleArray = array('roleArray');

        // 为 RoleTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(RoleTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray($role, [])->shouldBeCalled(1)->willReturn($roleArray);
        // 为 getRoleTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getRoleTranslator'
        )->willReturn($translator->reveal());

        return [$roleArray];
    }

    public function testPurviewFormatConversionToArray()
    {
        $stub = new StaffTranslatorMock();

        $purview = array(1=>2, 2=>4);

        $purviewResult = array(
            array(
                'id' => 1,
                'actions' => 2
            ),
            array(
                'id' => 2,
                'actions' => 4
            )
        );

        $result = $stub->purviewFormatConversionToArrayPublic($purview);
        $this->assertEquals($purviewResult, $result);
    }

    public function testPurviewFormatConversionToObject()
    {
        $stub = new StaffTranslatorMock();

        $purviewResult = array(1=>5, 2=>7);

        $purview = array(
            array(
                'id' => 1,
                'actions' => 5
            ),
            array(
                'id' => 2,
                'actions' => 7
            )
        );

        $result = $stub->purviewFormatConversionToObjectPublic($purview);
        $this->assertEquals($purviewResult, $result);
    }
}
