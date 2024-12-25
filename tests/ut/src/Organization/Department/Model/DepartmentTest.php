<?php
namespace Sdk\Organization\Department\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Organization\Organization\Model\Organization;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DepartmentTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new Department();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->stub
        );
    }

    public function testImplementsIOperateAble()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Model\Interfaces\IOperateAble',
            $this->stub
        );
    }
    /**
     * Department 领域对象,测试构造函数
     */
    public function testDepartmentConstructor()
    {
        $this->assertEmpty($this->stub->getId());
        $this->assertEmpty($this->stub->getName());
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\Organization',
            $this->stub->getOrganization()
        );
        $this->assertEmpty($this->stub->getStatus());
        $this->assertEmpty($this->stub->getCreateTime());
        $this->assertEmpty($this->stub->getUpdateTime());
        $this->assertEmpty($this->stub->getStatusTime());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 Department setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->stub->setId(3);
        $this->assertEquals(3, $this->stub->getId());
    }

    /**
     * 设置 Department setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->stub->setId('1');
        $this->assertTrue(is_int($this->stub->getId()));
        $this->assertEquals(1, $this->stub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //name 测试 -------------------------------------------------------- start
    /**
     * 设置 Department setName() 正确的传参类型,期望传值正确
     */
    public function testSetNameCorrectType()
    {
        $this->stub->setName('departmentName');
        $this->assertEquals('departmentName', $this->stub->getName());
    }

    /**
     * 设置 Department setName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetNameWrongType()
    {
        $this->stub->setName(array('departmentName'));
    }
    //name 测试 --------------------------------------------------------   end

    //organization 测试 -------------------------------------------------------- start
    /**
     * 设置 Department setOrganization() 正确的传参类型,期望传值正确
     */
    public function testSetOrganizationCorrectType()
    {
        $organization = new Organization();
        $this->stub->setOrganization($organization);
        $this->assertEquals($organization, $this->stub->getOrganization());
    }

    /**
     * 设置 Department setOrganization() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetOrganizationWrongType()
    {
        $this->stub->setOrganization(array('organization'));
    }
    //organization 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $stub = new DepartmentMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Department\Repository\DepartmentRepository',
            $stub->getRepositoryPublic()
        );
    }

    public function testEnable()
    {
        $this->assertFalse($this->stub->enable());
        $this->assertEquals(METHOD_NOT_ALLOWED, Core::getLastError()->getId());
    }

    public function testDisable()
    {
        $this->assertFalse($this->stub->disable());
        $this->assertEquals(METHOD_NOT_ALLOWED, Core::getLastError()->getId());
    }
}
