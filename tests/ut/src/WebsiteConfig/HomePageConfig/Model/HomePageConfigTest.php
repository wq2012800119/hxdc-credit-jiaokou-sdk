<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\WebsiteConfig\HomePageConfig\Repository\HomePageConfigRepository;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class HomePageConfigTest extends TestCase
{
    private $homeStub;

    protected function setUp(): void
    {
        $this->homeStub = new HomePageConfig();
    }

    protected function tearDown(): void
    {
        unset($this->homeStub);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->homeStub
        );
    }

    public function testImplementsIOperateAble()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Model\Interfaces\IOperateAble',
            $this->homeStub
        );
    }
    /**
     * HomePageConfig 领域对象,测试构造函数
     */
    public function testHomePageConfigConstructor()
    {
        $this->assertEmpty($this->homeStub->getId());
        $this->assertEmpty($this->homeStub->getVersionDescription());
        $this->assertEmpty($this->homeStub->getDiyContent());
        $this->assertInstanceOf(
            'Sdk\User\staff\Model\staff',
            $this->homeStub->getStaff()
        );
        $this->assertEmpty($this->homeStub->getStatus());
        $this->assertEmpty($this->homeStub->getCreateTime());
        $this->assertEmpty($this->homeStub->getUpdateTime());
        $this->assertEmpty($this->homeStub->getStatusTime());
    }

    //versionDescription 测试 -------------------------------------------------------- start
    /**
     * 设置 HomePageConfig setVersionDescription() 正确的传参类型,期望传值正确
     */
    public function testSetVersionDescriptionCorrectType()
    {
        $this->homeStub->setVersionDescription('versionDescription');
        $this->assertEquals('versionDescription', $this->homeStub->getVersionDescription());
    }

    /**
     * 设置 HomePageConfig setVersionDescription() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetVersionDescriptionWrongType()
    {
        $this->homeStub->setVersionDescription(array('versionDescription'));
    }
    //versionDescription 测试 --------------------------------------------------------   end

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 HomePageConfig setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->homeStub->setId(5);
        $this->assertEquals(5, $this->homeStub->getId());
    }

    /**
     * 设置 HomePageConfig setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->homeStub->setId('1');
        $this->assertTrue(is_int($this->homeStub->getId()));
        $this->assertEquals(1, $this->homeStub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //diyContent 测试 -------------------------------------------------------- start
    /**
     * 设置 HomePageConfig setDiyContent() 正确的传参类型,期望传值正确
     */
    public function testSetDiyContentCorrectType()
    {
        $this->homeStub->setDiyContent(array('diyContent'));
        $this->assertEquals(array('diyContent'), $this->homeStub->getDiyContent());
    }

    /**
     * 设置 HomePageConfig setDiyContent() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDiyContentWrongType()
    {
        $this->homeStub->setDiyContent('diyContent');
    }
    //diyContent 测试 --------------------------------------------------------   end
    //staff 测试 -------------------------------------------------------- start
    /**
     * 设置 HomePageConfig setStaff() 正确的传参类型,期望传值正确
     */
    public function testSetStaffCorrectType()
    {
        $staff = new OrganizationUserStaff();
        $this->homeStub->setStaff($staff);
        $this->assertEquals($staff, $this->homeStub->getStaff());
    }

    /**
     * 设置 HomePageConfig setStaff() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStaffWrongType()
    {
        $this->homeStub->setStaff(array('staff'));
    }
    //staff 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $homeStub = new HomePageConfigMock();
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HomePageConfig\Repository\HomePageConfigRepository',
            $homeStub->getRepositoryPublic()
        );
    }

    public function testEnable()
    {
        $this->assertFalse($this->homeStub->enable());
        $this->assertEquals(METHOD_NOT_ALLOWED, Core::getLastError()->getId());
    }

    public function testDisable()
    {
        $this->assertFalse($this->homeStub->disable());
        $this->assertEquals(METHOD_NOT_ALLOWED, Core::getLastError()->getId());
    }

    public function testUpdate()
    {
        $this->assertFalse($this->homeStub->update());
        $this->assertEquals(METHOD_NOT_ALLOWED, Core::getLastError()->getId());
    }

    public function testPublish()
    {
        $stub = $this->getMockBuilder(HomePageConfigMock::class)->setMethods(['getRepository'])->getMock();

        // 为 HomePageConfigRepository 类建立预言(prophecy)。
        $repository = $this->prophesize(HomePageConfigRepository::class);
        // 建立预期状况:publish() 方法将会被调用一次。
        $repository->publish($stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());

        $result = $stub->publish();

        $this->assertTrue($result);
    }
}
