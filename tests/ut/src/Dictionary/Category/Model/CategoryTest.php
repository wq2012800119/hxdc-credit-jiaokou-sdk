<?php
namespace Sdk\Dictionary\Category\Model;

use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    private $category;

    protected function setUp(): void
    {
        $this->category = new Category();
    }

    protected function tearDown(): void
    {
        unset($this->category);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->category
        );
    }

    /**
     * Category 领域对象,测试构造函数
     */
    public function testCategoryConstructor()
    {
        $this->assertEmpty($this->category->getId());
        $this->assertEmpty($this->category->getName());
        $this->assertEmpty($this->category->getStatus());
        $this->assertEmpty($this->category->getCreateTime());
        $this->assertEmpty($this->category->getUpdateTime());
        $this->assertEmpty($this->category->getStatusTime());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 Category setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->category->setId(1);
        $this->assertEquals(1, $this->category->getId());
    }

    /**
     * 设置 Category setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->category->setId('1');
        $this->assertTrue(is_int($this->category->getId()));
        $this->assertEquals(1, $this->category->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //name 测试 -------------------------------------------------------- start
    /**
     * 设置 Category setName() 正确的传参类型,期望传值正确
     */
    public function testSetNameCorrectType()
    {
        $this->category->setName('string');
        $this->assertEquals('string', $this->category->getName());
    }

    /**
     * 设置 Category setName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetNameWrongType()
    {
        $this->category->setName(array(1,2,3));
    }
    //name 测试 --------------------------------------------------------   end

    //status 测试 -------------------------------------------------------- start
    /**
     * 设置 Category setStatus() 正确的传参类型,期望传值正确
     */
    public function testSetStatusCorrectType()
    {
        $this->category->setStatus(1);
        $this->assertEquals(1, $this->category->getStatus());
    }

    /**
     * 设置 Category setStatus() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStatusWrongType()
    {
        $this->category->setStatus(array(1,2,3));
    }
    //status 测试 --------------------------------------------------------   end
}
