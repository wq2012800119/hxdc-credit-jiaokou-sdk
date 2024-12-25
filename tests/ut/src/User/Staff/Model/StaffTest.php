<?php
namespace Sdk\User\Staff\Model;

use PHPUnit\Framework\TestCase;

use Sdk\Organization\Department\Model\Department;
use Sdk\Organization\Organization\Model\Organization;

use Sdk\User\Staff\Repository\StaffRepository;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class StaffTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(StaffMock::class)
                           ->setMethods(['getRepository', 'getStaffJwtAuth'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsUser()
    {
        $this->assertInstanceOf(
            'Sdk\User\Model\User',
            $this->stub
        );
    }

    /**
     * Staff 领域对象,测试构造函数
     */
    public function testStaffConstructor()
    {
        $this->assertEmpty($this->stub->getId());
        $this->assertEmpty($this->stub->getCategory());
        $this->assertEmpty($this->stub->getIdentification());
        $this->assertEmpty($this->stub->getPurview());
        $this->assertEmpty($this->stub->getRoles());
        $this->assertInstanceOf(
            'Sdk\Organization\Department\Model\Department',
            $this->stub->getDepartment()
        );
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\Organization',
            $this->stub->getOrganization()
        );
    }

    //category 测试 -------------------------------------------------------- start
    /**
     * 设置 Staff setCategory() 正确的传参类型,期望传值正确
     */
    public function testSetCategoryCorrectType()
    {
        $this->stub->setCategory(1);
        $this->assertEquals(1, $this->stub->getCategory());
    }

    /**
     * 设置 Staff setCategory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetCategoryWrongType()
    {
        $this->stub->setCategory(array('staffCategory'));
    }
    //category 测试 --------------------------------------------------------   end

    //identification 测试 -------------------------------------------------------- start
    /**
     * 设置 Staff setIdentification() 正确的传参类型,期望传值正确
     */
    public function testSetIdentificationCorrectType()
    {
        $this->stub->setIdentification('staffIdentification');
        $this->assertEquals('staffIdentification', $this->stub->getIdentification());
    }

    /**
     * 设置 Staff setIdentification() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetIdentificationWrongType()
    {
        $this->stub->setIdentification(array('staffIdentification'));
    }
    //identification 测试 --------------------------------------------------------   end

    //purview 测试 -------------------------------------------------------- start
    /**
     * 设置 Staff setPurview() 正确的传参类型,期望传值正确
     */
    public function testSetPurviewCorrectType()
    {
        $this->stub->setPurview(array('purviews'));
        $this->assertEquals(array('purviews'), $this->stub->getPurview());
    }

    /**
     * 设置 Staff setPurview() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetPurviewWrongType()
    {
        $this->stub->setPurview('purview');
    }
    //purview 测试 --------------------------------------------------------   end

    //roles 测试 -------------------------------------------------------- start
    /**
     * 设置 Staff setRoles() 正确的传参类型,期望传值正确
     */
    public function testSetRolesCorrectType()
    {
        $this->stub->setRoles(array('roles'));
        $this->assertEquals(array('roles'), $this->stub->getRoles());
    }

    /**
     * 设置 Staff setRoles() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetRolesWrongType()
    {
        $this->stub->setRoles('roles');
    }
    //roles 测试 --------------------------------------------------------   end

    //organization 测试 -------------------------------------------------------- start
    /**
     * 设置 Staff setOrganization() 正确的传参类型,期望传值正确
     */
    public function testSetOrganizationCorrectType()
    {
        $organization = new Organization();
        $this->stub->setOrganization($organization);
        $this->assertEquals($organization, $this->stub->getOrganization());
    }

    /**
     * 设置 Staff setOrganization() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetOrganizationWrongType()
    {
        $this->stub->setOrganization(array('staffOrganization'));
    }
    //organization 测试 --------------------------------------------------------   end

    //department 测试 -------------------------------------------------------- start
    /**
     * 设置 Staff setDepartment() 正确的传参类型,期望传值正确
     */
    public function testSetDepartmentCorrectType()
    {
        $department = new Department();
        $this->stub->setDepartment($department);
        $this->assertEquals($department, $this->stub->getDepartment());
    }

    /**
     * 设置 Staff setDepartment() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDepartmentWrongType()
    {
        $this->stub->setDepartment(array('staffDepartment'));
    }
    //department 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $stub = new StaffMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Repository\StaffRepository',
            $stub->getRepositoryPublic()
        );
    }

    public function testGetStaffJwtAuth()
    {
        $stub = new StaffMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\StaffJwtAuth',
            $stub->getStaffJwtAuthPublic()
        );
    }

    public function testCreateNull()
    {
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\NullStaff',
            $this->stub->create(0)
        );
    }

    public function testCreate()
    {
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\SuperUserStaff',
            $this->stub->create(Staff::CATEGORY['SUPER_USER'])
        );
    }

    public function testLogin()
    {
        // 为 StaffRepository 类建立预言(prophecy)。
        $repository = $this->prophesize(StaffRepository::class);
        // 建立预期状况:login() 方法将会被调用一次。
        $repository->login($this->stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());

        // 为 StaffJwtAuth 类建立预言(prophecy)。
        $staffJwtAuth = $this->prophesize(StaffJwtAuth::class);
        // 建立预期状况:generateJwtAndSaveStaffToCache() 方法将会被调用一次。
        $staffJwtAuth->generateJwtAndSaveStaffToCache($this->stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getStaffJwtAuth')->willReturn($staffJwtAuth->reveal());

        $result = $this->stub->login();

        $this->assertTrue($result);
    }

    public function testLogout()
    {
        // 为 StaffJwtAuth 类建立预言(prophecy)。
        $staffJwtAuth = $this->prophesize(StaffJwtAuth::class);
        // 建立预期状况:generateJwtAndSaveStaffToCache() 方法将会被调用一次。
        $staffJwtAuth->clearJwtAndStaffToCache($this->stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getStaffJwtAuth')->willReturn($staffJwtAuth->reveal());

        $result = $this->stub->logout();

        $this->assertTrue($result);
    }

    public function testResetPassword()
    {
        // 为 StaffRepository 类建立预言(prophecy)。
        $repository = $this->prophesize(StaffRepository::class);
        // 建立预期状况:resetPassword() 方法将会被调用一次。
        $repository->resetPassword($this->stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());

        $result = $this->stub->resetPassword();

        $this->assertTrue($result);
    }

    public function testUpdatePassword()
    {
        // 为 StaffRepository 类建立预言(prophecy)。
        $repository = $this->prophesize(StaffRepository::class);
        // 建立预期状况:updatePassword() 方法将会被调用一次。
        $repository->updatePassword($this->stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());

        $result = $this->stub->updatePassword();

        $this->assertTrue($result);
    }
}
