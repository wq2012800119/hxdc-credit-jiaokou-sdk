<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\User\Staff\Model\OrganizationUserStaff;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class HelpPageConfigTest extends TestCase
{
    private $configStub;

    protected function setUp(): void
    {
        $this->configStub = new HelpPageConfig();
    }

    protected function tearDown(): void
    {
        unset($this->configStub);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->configStub
        );
    }

    public function testImplementsIOperateAble()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Model\Interfaces\IOperateAble',
            $this->configStub
        );
    }
    /**
     * HelpPageConfig 领域对象,测试构造函数
     */
    public function testHelpPageConfigConstructor()
    {
        $this->assertEmpty($this->configStub->getId());
        $this->assertEmpty($this->configStub->getTitle());
        $this->assertEmpty($this->configStub->getStyle());
        $this->assertEmpty($this->configStub->getDiyContent());
        $this->assertInstanceOf(
            'Sdk\User\staff\Model\staff',
            $this->configStub->getStaff()
        );
        $this->assertEmpty($this->configStub->getStatus());
        $this->assertEmpty($this->configStub->getCreateTime());
        $this->assertEmpty($this->configStub->getUpdateTime());
        $this->assertEmpty($this->configStub->getStatusTime());
    }

    //title 测试 -------------------------------------------------------- start
    /**
     * 设置 HelpPageConfig setTitle() 正确的传参类型,期望传值正确
     */
    public function testSetTitleCorrectType()
    {
        $this->configStub->setTitle('configTitle');
        $this->assertEquals('configTitle', $this->configStub->getTitle());
    }

    /**
     * 设置 HelpPageConfig setTitle() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetTitleWrongType()
    {
        $this->configStub->setTitle(array('helpPageConfigTitle'));
    }
    //title 测试 --------------------------------------------------------   end

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 HelpPageConfig setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->configStub->setId(5);
        $this->assertEquals(5, $this->configStub->getId());
    }

    /**
     * 设置 HelpPageConfig setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->configStub->setId('1');
        $this->assertTrue(is_int($this->configStub->getId()));
        $this->assertEquals(1, $this->configStub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //style 测试 -------------------------------------------------------- start
    /**
     * 设置 HelpPageConfig setStyle() 正确的传参类型,期望传值正确
     */
    public function testSetStyleCorrectType()
    {
        $this->configStub->setStyle(1);
        $this->assertEquals(1, $this->configStub->getStyle());
    }

    /**
     * 设置 HelpPageConfig setStyle() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStyleWrongType()
    {
        $this->configStub->setStyle(array('helpPageConfigStyle'));
    }
    //style 测试 --------------------------------------------------------   end

    //diyContent 测试 -------------------------------------------------------- start
    /**
     * 设置 HelpPageConfig setDiyContent() 正确的传参类型,期望传值正确
     */
    public function testSetDiyContentCorrectType()
    {
        $this->configStub->setDiyContent(array('diyContent'));
        $this->assertEquals(array('diyContent'), $this->configStub->getDiyContent());
    }

    /**
     * 设置 HelpPageConfig setDiyContent() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDiyContentWrongType()
    {
        $this->configStub->setDiyContent('diyContent');
    }
    //diyContent 测试 --------------------------------------------------------   end
    //staff 测试 -------------------------------------------------------- start
    /**
     * 设置 HelpPageConfig setStaff() 正确的传参类型,期望传值正确
     */
    public function testSetStaffCorrectType()
    {
        $staff = new OrganizationUserStaff();
        $this->configStub->setStaff($staff);
        $this->assertEquals($staff, $this->configStub->getStaff());
    }

    /**
     * 设置 HelpPageConfig setStaff() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStaffWrongType()
    {
        $this->configStub->setStaff(array('staff'));
    }
    //staff 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $configStub = new HelpPageConfigMock();
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HelpPageConfig\Repository\HelpPageConfigRepository',
            $configStub->getRepositoryPublic()
        );
    }

    public function testEnable()
    {
        $this->assertFalse($this->configStub->enable());
        $this->assertEquals(METHOD_NOT_ALLOWED, Core::getLastError()->getId());
    }

    public function testDisable()
    {
        $this->assertFalse($this->configStub->disable());
        $this->assertEquals(METHOD_NOT_ALLOWED, Core::getLastError()->getId());
    }
}
