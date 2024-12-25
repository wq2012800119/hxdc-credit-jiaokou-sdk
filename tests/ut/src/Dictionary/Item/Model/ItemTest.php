<?php
namespace Sdk\Dictionary\Item\Model;

use PHPUnit\Framework\TestCase;

use Sdk\Dictionary\Category\Model\Category;

class ItemTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new Item();
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
     * Item 领域对象,测试构造函数
     */
    public function testItemConstructor()
    {
        $this->assertEmpty($this->stub->getId());
        $this->assertEmpty($this->stub->getName());
        $this->assertInstanceOf(
            'Sdk\Dictionary\Category\Model\Category',
            $this->stub->getCategory()
        );
        $this->assertEquals(Item::STATUS['ENABLED'], $this->stub->getStatus());
        $this->assertEmpty($this->stub->getCreateTime());
        $this->assertEmpty($this->stub->getUpdateTime());
        $this->assertEmpty($this->stub->getStatusTime());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 Item setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->stub->setId(1);
        $this->assertEquals(1, $this->stub->getId());
    }

    /**
     * 设置 Item setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
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
     * 设置 Item setName() 正确的传参类型,期望传值正确
     */
    public function testSetNameCorrectType()
    {
        $this->stub->setName('name');
        $this->assertEquals('name', $this->stub->getName());
    }

    /**
     * 设置 Item setName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetNameWrongType()
    {
        $this->stub->setName(array('name'));
    }
    //name 测试 --------------------------------------------------------   end

    //category 测试 -------------------------------------------------------- start
    /**
     * 设置 Item setCategory() 正确的传参类型,期望传值正确
     */
    public function testSetCategoryCorrectType()
    {
        $category = new Category();
        $this->stub->setCategory($category);
        $this->assertEquals($category, $this->stub->getCategory());
    }

    /**
     * 设置 Item setCategory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetCategoryWrongType()
    {
        $this->stub->setCategory(array('category'));
    }
    //category 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $stub = new ItemMock();
        $this->assertInstanceOf(
            'Sdk\Dictionary\Item\Repository\ItemRepository',
            $stub->getRepositoryPublic()
        );
    }
}
