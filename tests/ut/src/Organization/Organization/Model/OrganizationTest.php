<?php
namespace Sdk\Organization\Organization\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Dictionary\Item\Model\Item;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class OrganizationTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new Organization();
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
     * Organization 领域对象,测试构造函数
     */
    public function testOrganizationConstructor()
    {
        $this->assertEmpty($this->stub->getId());
        $this->assertEmpty($this->stub->getName());
        $this->assertEmpty($this->stub->getShortName());
        $this->assertEmpty($this->stub->getUnifiedIdentifier());
        $this->assertInstanceOf(
            'Sdk\Dictionary\Item\Model\Item',
            $this->stub->getJurisdictionArea()
        );
        $this->assertEmpty($this->stub->getStatus());
        $this->assertEmpty($this->stub->getCreateTime());
        $this->assertEmpty($this->stub->getUpdateTime());
        $this->assertEmpty($this->stub->getStatusTime());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 Organization setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->stub->setId(4);
        $this->assertEquals(4, $this->stub->getId());
    }

    /**
     * 设置 Organization setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
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
     * 设置 Organization setName() 正确的传参类型,期望传值正确
     */
    public function testSetNameCorrectType()
    {
        $this->stub->setName('organizationName');
        $this->assertEquals('organizationName', $this->stub->getName());
    }

    /**
     * 设置 Organization setName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetNameWrongType()
    {
        $this->stub->setName(array('organizationName'));
    }
    //name 测试 --------------------------------------------------------   end

    //shortName 测试 -------------------------------------------------------- start
    /**
     * 设置 Organization setShortName() 正确的传参类型,期望传值正确
     */
    public function testSetShortNameCorrectType()
    {
        $this->stub->setShortName('organizationShortName');
        $this->assertEquals('organizationShortName', $this->stub->getShortName());
    }

    /**
     * 设置 Organization setShortName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetShortNameWrongType()
    {
        $this->stub->setShortName(array('organizationShortName'));
    }
    //shortName 测试 --------------------------------------------------------   end

    //unifiedIdentifier 测试 -------------------------------------------------------- start
    /**
     * 设置 Organization setUnifiedIdentifier() 正确的传参类型,期望传值正确
     */
    public function testSetUnifiedIdentifierCorrectType()
    {
        $this->stub->setUnifiedIdentifier('unifiedIdentifier');
        $this->assertEquals('unifiedIdentifier', $this->stub->getUnifiedIdentifier());
    }

    /**
     * 设置 Organization setUnifiedIdentifier() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetUnifiedIdentifierWrongType()
    {
        $this->stub->setUnifiedIdentifier(array('unifiedIdentifier'));
    }
    //unifiedIdentifier 测试 --------------------------------------------------------   end

    //jurisdictionArea 测试 -------------------------------------------------------- start
    /**
     * 设置 Organization setJurisdictionArea() 正确的传参类型,期望传值正确
     */
    public function testSetJurisdictionAreaCorrectType()
    {
        $jurisdictionArea = new Item();
        $this->stub->setJurisdictionArea($jurisdictionArea);
        $this->assertEquals($jurisdictionArea, $this->stub->getJurisdictionArea());
    }

    /**
     * 设置 Organization setJurisdictionArea() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetJurisdictionAreaWrongType()
    {
        $this->stub->setJurisdictionArea(array('jurisdictionArea'));
    }
    //jurisdictionArea 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $stub = new OrganizationMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Repository\OrganizationRepository',
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
