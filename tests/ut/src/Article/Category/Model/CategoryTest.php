<?php
namespace Sdk\Article\Category\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\Article\Category\Repository\CategoryRepository;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class CategoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new Category();
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
     * Category 领域对象,测试构造函数
     */
    public function testCategoryConstructor()
    {
        $this->assertEmpty($this->stub->getId());
        $this->assertEmpty($this->stub->getName());
        $this->assertEmpty($this->stub->getLevel());
        $this->assertEmpty($this->stub->getStyle());
        $this->assertEmpty($this->stub->getDiyContent());
        $this->assertEmpty($this->stub->getParentCategoryId());
        $this->assertEmpty($this->stub->getParentCategoryName());
        $this->assertInstanceOf(
            'Sdk\User\staff\Model\staff',
            $this->stub->getStaff()
        );
        $this->assertEmpty($this->stub->getStatus());
        $this->assertEmpty($this->stub->getCreateTime());
        $this->assertEmpty($this->stub->getUpdateTime());
        $this->assertEmpty($this->stub->getStatusTime());
    }

    //name 测试 -------------------------------------------------------- start
    /**
     * 设置 Category setName() 正确的传参类型,期望传值正确
     */
    public function testSetNameCorrectType()
    {
        $this->stub->setName('articleCategoryName');
        $this->assertEquals('articleCategoryName', $this->stub->getName());
    }

    /**
     * 设置 Category setName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetNameWrongType()
    {
        $this->stub->setName(array('categoryName'));
    }
    //name 测试 --------------------------------------------------------   end

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 Category setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->stub->setId(5);
        $this->assertEquals(5, $this->stub->getId());
    }

    /**
     * 设置 Category setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->stub->setId('1');
        $this->assertTrue(is_int($this->stub->getId()));
        $this->assertEquals(1, $this->stub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //level 测试 -------------------------------------------------------- start
    /**
     * 设置 Category setLevel() 正确的传参类型,期望传值正确
     */
    public function testSetLevelCorrectType()
    {
        $this->stub->setLevel(1);
        $this->assertEquals(1, $this->stub->getLevel());
    }

    /**
     * 设置 Category setLevel() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetLevelWrongType()
    {
        $this->stub->setLevel(array('categoryLevel'));
    }
    //level 测试 --------------------------------------------------------   end

    //style 测试 -------------------------------------------------------- start
    /**
     * 设置 Category setStyle() 正确的传参类型,期望传值正确
     */
    public function testSetStyleCorrectType()
    {
        $this->stub->setStyle(1);
        $this->assertEquals(1, $this->stub->getStyle());
    }

    /**
     * 设置 Category setStyle() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStyleWrongType()
    {
        $this->stub->setStyle(array('categoryStyle'));
    }
    //style 测试 --------------------------------------------------------   end

    //diyContent 测试 -------------------------------------------------------- start
    /**
     * 设置 Category setDiyContent() 正确的传参类型,期望传值正确
     */
    public function testSetDiyContentCorrectType()
    {
        $this->stub->setDiyContent(array('diyContent'));
        $this->assertEquals(array('diyContent'), $this->stub->getDiyContent());
    }

    /**
     * 设置 Category setDiyContent() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDiyContentWrongType()
    {
        $this->stub->setDiyContent('diyContent');
    }
    //diyContent 测试 --------------------------------------------------------   end

    //parentCategoryId 测试 -------------------------------------------------------- start
    /**
     * 设置 Category setParentCategoryId() 正确的传参类型,期望传值正确
     */
    public function testSetParentCategoryIdCorrectType()
    {
        $this->stub->setParentCategoryId(1);
        $this->assertEquals(1, $this->stub->getParentCategoryId());
    }

    /**
     * 设置 Category setParentCategoryId() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetParentCategoryIdWrongType()
    {
        $this->stub->setParentCategoryId(array('id'));
    }
    //parentCategoryId 测试 --------------------------------------------------------   end

    //parentCategoryName 测试 -------------------------------------------------------- start
    /**
     * 设置 Category setParentCategoryName() 正确的传参类型,期望传值正确
     */
    public function testSetParentCategoryNameCorrectType()
    {
        $this->stub->setParentCategoryName('parentCategoryName');
        $this->assertEquals('parentCategoryName', $this->stub->getParentCategoryName());
    }

    /**
     * 设置 Category setParentCategoryName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetParentCategoryNameWrongType()
    {
        $this->stub->setParentCategoryName(array('parentCategoryName'));
    }
    //parentCategoryName 测试 --------------------------------------------------------   end
    //staff 测试 -------------------------------------------------------- start
    /**
     * 设置 Category setStaff() 正确的传参类型,期望传值正确
     */
    public function testSetStaffCorrectType()
    {
        $staff = new OrganizationUserStaff();
        $this->stub->setStaff($staff);
        $this->assertEquals($staff, $this->stub->getStaff());
    }

    /**
     * 设置 Category setStaff() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStaffWrongType()
    {
        $this->stub->setStaff(array('staff'));
    }
    //staff 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $stub = new CategoryMock();
        $this->assertInstanceOf(
            'Sdk\Article\Category\Repository\CategoryRepository',
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

    public function testDiy()
    {
        $stub = $this->getMockBuilder(CategoryMock::class)->setMethods(['getRepository'])->getMock();

        // 为 CategoryRepository 类建立预言(prophecy)。
        $repository = $this->prophesize(CategoryRepository::class);
        // 建立预期状况:diy() 方法将会被调用一次。
        $repository->diy($stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());

        $result = $stub->diy();

        $this->assertTrue($result);
    }
}
