<?php
namespace Sdk\Role\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class RoleTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new Role();
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
     * Role 领域对象,测试构造函数
     */
    public function testRoleConstructor()
    {
        $this->assertEmpty($this->stub->getId());
        $this->assertEmpty($this->stub->getName());
        $this->assertEmpty($this->stub->getPurview());
        $this->assertEmpty($this->stub->getStatus());
        $this->assertEmpty($this->stub->getCreateTime());
        $this->assertEmpty($this->stub->getUpdateTime());
        $this->assertEmpty($this->stub->getStatusTime());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 Role setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->stub->setId(5);
        $this->assertEquals(5, $this->stub->getId());
    }

    /**
     * 设置 Role setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
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
     * 设置 Role setName() 正确的传参类型,期望传值正确
     */
    public function testSetNameCorrectType()
    {
        $this->stub->setName('roleName');
        $this->assertEquals('roleName', $this->stub->getName());
    }

    /**
     * 设置 Role setName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetNameWrongType()
    {
        $this->stub->setName(array('roleName'));
    }
    //name 测试 --------------------------------------------------------   end

    //purview 测试 -------------------------------------------------------- start
    /**
     * 设置 Role setPurview() 正确的传参类型,期望传值正确
     */
    public function testSetPurviewCorrectType()
    {
        $this->stub->setPurview(array('rolePurview'));
        $this->assertEquals(array('rolePurview'), $this->stub->getPurview());
    }

    /**
     * 设置 Role setPurview() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetPurviewWrongType()
    {
        $this->stub->setPurview('rolePurview');
    }
    //purview 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $stub = new RoleMock();
        $this->assertInstanceOf(
            'Sdk\Role\Repository\RoleRepository',
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
