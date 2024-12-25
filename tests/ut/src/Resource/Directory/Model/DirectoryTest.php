<?php
namespace Sdk\Resource\Directory\Model;

use PHPUnit\Framework\TestCase;

use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\Organization\Organization\Model\Organization;
use Sdk\Resource\Directory\Repository\DirectoryRepository;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DirectoryTest extends TestCase
{
    private $directoryStub;

    protected function setUp(): void
    {
        $this->directoryStub = new Directory();
    }

    protected function tearDown(): void
    {
        unset($this->directoryStub);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->directoryStub
        );
    }

    public function testImplementsIOperateAble()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Model\Interfaces\IOperateAble',
            $this->directoryStub
        );
    }

    public function testImplementsIExamineAble()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Model\Interfaces\IExamineAble',
            $this->directoryStub
        );
    }
    /**
     * Directory 领域对象,测试构造函数
     */
    public function testDirectoryConstructor()
    {
        $this->assertEmpty($this->directoryStub->getId());
        $this->assertEmpty($this->directoryStub->getName());
        $this->assertEmpty($this->directoryStub->getIdentify());
        $this->assertEmpty($this->directoryStub->getReadOnly());
        $this->assertEmpty($this->directoryStub->getSubjectCategory());
        $this->assertEmpty($this->directoryStub->getInfoCategory());
        $this->assertEmpty($this->directoryStub->getSourceUnits());
        $this->assertEmpty($this->directoryStub->getDescription());
        $this->assertEmpty($this->directoryStub->getItems());
        $this->assertEmpty($this->directoryStub->getVersion());
        $this->assertEmpty($this->directoryStub->getSnapshotId());
        $this->assertEmpty($this->directoryStub->getVersionDescription());
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\Organization',
            $this->directoryStub->getOrganization()
        );
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\Staff',
            $this->directoryStub->getStaff()
        );
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\Template',
            $this->directoryStub->getTemplate()
        );
        $this->assertEquals(Directory::EXAMINE_STATUS['PENDING'], $this->directoryStub->getExamineStatus());
        $this->assertEquals(Directory::STATUS['ENABLED'], $this->directoryStub->getStatus());
        $this->assertEmpty($this->directoryStub->getCreateTime());
        $this->assertEmpty($this->directoryStub->getUpdateTime());
        $this->assertEmpty($this->directoryStub->getStatusTime());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 Directory setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->directoryStub->setId(1);
        $this->assertEquals(1, $this->directoryStub->getId());
    }

    /**
     * 设置 Directory setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->directoryStub->setId('1');
        $this->assertTrue(is_int($this->directoryStub->getId()));
        $this->assertEquals(1, $this->directoryStub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //name 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setName() 正确的传参类型,期望传值正确
     */
    public function testSetNameCorrectType()
    {
        $this->directoryStub->setName('directoryName');
        $this->assertEquals('directoryName', $this->directoryStub->getName());
    }

    /**
     * 设置 Directory setName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetNameWrongType()
    {
        $this->directoryStub->setName(array('directoryName'));
    }
    //name 测试 --------------------------------------------------------   end

    //identify 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setIdentify() 正确的传参类型,期望传值正确
     */
    public function testSetIdentifyCorrectType()
    {
        $this->directoryStub->setIdentify('identify');
        $this->assertEquals('identify', $this->directoryStub->getIdentify());
    }

    /**
     * 设置 Directory setIdentify() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetIdentifyWrongType()
    {
        $this->directoryStub->setIdentify(array('identify'));
    }
    //identify 测试 --------------------------------------------------------   end

    //readOnly 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setReadOnly() 正确的传参类型,期望传值正确
     */
    public function testSetReadOnlyCorrectType()
    {
        $this->directoryStub->setReadOnly(3);
        $this->assertEquals(3, $this->directoryStub->getReadOnly());
    }

    /**
     * 设置 Directory setReadOnly() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetReadOnlyWrongType()
    {
        $this->directoryStub->setReadOnly(array('readOnly'));
    }
    //readOnly 测试 --------------------------------------------------------   end

    //subjectCategory 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setSubjectCategory() 正确的传参类型,期望传值正确
     */
    public function testSetSubjectCategoryCorrectType()
    {
        $this->directoryStub->setSubjectCategory(array('subjectCategory'));
        $this->assertEquals(array('subjectCategory'), $this->directoryStub->getSubjectCategory());
    }

    /**
     * 设置 Directory setSubjectCategory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSubjectCategoryWrongType()
    {
        $this->directoryStub->setSubjectCategory('subjectCategory');
    }
    //subjectCategory 测试 --------------------------------------------------------   end

    //infoCategory 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setInfoCategory() 正确的传参类型,期望传值正确
     */
    public function testSetInfoCategoryCorrectType()
    {
        $this->directoryStub->setInfoCategory(1);
        $this->assertEquals(1, $this->directoryStub->getInfoCategory());
    }

    /**
     * 设置 Directory setInfoCategory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetInfoCategoryWrongType()
    {
        $this->directoryStub->setInfoCategory(array('infoCategory'));
    }
    //infoCategory 测试 --------------------------------------------------------   end

    //sourceUnits 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory addSourceUnit() 正确的传参类型,期望传值正确
     */
    public function testAddSourceUnitCorrectType()
    {
        $sourceUnit = new Organization();
        $this->directoryStub->addSourceUnit($sourceUnit);
        $this->assertEquals([$sourceUnit], $this->directoryStub->getSourceUnits());
    }

    /**
     * 设置 Directory addSourceUnit() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testAddSourceUnitWrongType()
    {
        $this->directoryStub->addSourceUnit(array('sourceUnit'));
    }

    public function testClearSourceUnitsCorrectType()
    {
        $this->directoryStub->clearSourceUnits();
        $this->assertEmpty($this->directoryStub->getSourceUnits());
    }
    /**
     * 设置 Directory setSourceUnits() 正确的传参类型,期望传值正确
     */
    public function testSetSourceUnitsCorrectType()
    {
        $this->directoryStub->setSourceUnits(array('sourceUnits'));
        $this->assertEquals(array('sourceUnits'), $this->directoryStub->getSourceUnits());
    }

    /**
     * 设置 Directory setSourceUnits() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSourceUnitsWrongType()
    {
        $this->directoryStub->setSourceUnits('sourceUnits');
    }
    //sourceUnits 测试 --------------------------------------------------------   end

    //description 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setDescription() 正确的传参类型,期望传值正确
     */
    public function testSetDescriptionCorrectType()
    {
        $this->directoryStub->setDescription('description');
        $this->assertEquals('description', $this->directoryStub->getDescription());
    }

    /**
     * 设置 Directory setDescription() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDescriptionWrongType()
    {
        $this->directoryStub->setDescription(array('description'));
    }
    //description 测试 --------------------------------------------------------   end

    //version 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setVersion() 正确的传参类型,期望传值正确
     */
    public function testSetVersionCorrectType()
    {
        $this->directoryStub->setVersion('version');
        $this->assertEquals('version', $this->directoryStub->getVersion());
    }

    /**
     * 设置 Directory setVersion() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetVersionWrongType()
    {
        $this->directoryStub->setVersion(array('version'));
    }
    //version 测试 --------------------------------------------------------   end

    //versionDescription 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setVersionDescription() 正确的传参类型,期望传值正确
     */
    public function testSetVersionDescriptionCorrectType()
    {
        $this->directoryStub->setVersionDescription('versionDescription');
        $this->assertEquals('versionDescription', $this->directoryStub->getVersionDescription());
    }

    /**
     * 设置 Directory setVersionDescription() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetVersionDescriptionWrongType()
    {
        $this->directoryStub->setVersionDescription(array('versionDescription'));
    }
    //versionDescription 测试 --------------------------------------------------------   end

    //items 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setItems() 正确的传参类型,期望传值正确
     */
    public function testSetItemsCorrectType()
    {
        $this->directoryStub->setItems(array('items'));
        $this->assertEquals(array('items'), $this->directoryStub->getItems());
    }

    /**
     * 设置 Directory setItems() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetItemsWrongType()
    {
        $this->directoryStub->setItems('items');
    }
    //items 测试 --------------------------------------------------------   end
    
    //organization 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setOrganization() 正确的传参类型,期望传值正确
     */
    public function testSetOrganizationCorrectType()
    {
        $organization = new Organization();
        $this->directoryStub->setOrganization($organization);
        $this->assertEquals($organization, $this->directoryStub->getOrganization());
    }

    /**
     * 设置 Directory setOrganization() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetOrganizationWrongType()
    {
        $this->directoryStub->setOrganization(array('organization'));
    }
    //organization 测试 --------------------------------------------------------   end

    //template 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setTemplate() 正确的传参类型,期望传值正确
     */
    public function testSetTemplateCorrectType()
    {
        $template = new Template();
        $this->directoryStub->setTemplate($template);
        $this->assertEquals($template, $this->directoryStub->getTemplate());
    }

    /**
     * 设置 Directory setTemplate() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetTemplateWrongType()
    {
        $this->directoryStub->setTemplate(array('template'));
    }
    //template 测试 --------------------------------------------------------   end

    //staff 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setStaff() 正确的传参类型,期望传值正确
     */
    public function testSetStaffCorrectType()
    {
        $staff = new OrganizationUserStaff();
        $this->directoryStub->setStaff($staff);
        $this->assertEquals($staff, $this->directoryStub->getStaff());
    }

    /**
     * 设置 Directory setStaff() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStaffWrongType()
    {
        $this->directoryStub->setStaff(array('staff'));
    }
    //staff 测试 --------------------------------------------------------   end

    //snapshotId 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setSnapshotId() 正确的传参类型,期望传值正确
     */
    public function testSetSnapshotIdCorrectType()
    {
        $this->directoryStub->setSnapshotId(1);
        $this->assertEquals(1, $this->directoryStub->getSnapshotId());
    }

    /**
     * 设置 Directory setSnapshotId() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSnapshotIdWrongType()
    {
        $this->directoryStub->setSnapshotId(array('snapshotId'));
    }
    //snapshotId 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $directoryStub = new DirectoryMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Repository\DirectoryRepository',
            $directoryStub->getRepositoryPublic()
        );
    }

    public function testRollback()
    {
        $stub = $this->getMockBuilder(DirectoryMock::class)->setMethods(['getRepository'])->getMock();

        // 为 DirectoryRepository 类建立预言(prophecy)。
        $repository = $this->prophesize(DirectoryRepository::class);
        // 建立预期状况:rollback() 方法将会被调用一次。
        $repository->rollback($stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());

        $result = $stub->rollback();

        $this->assertTrue($result);
    }

    public function testExport()
    {
        $stub = $this->getMockBuilder(DirectoryMock::class)->setMethods(['getRepository'])->getMock();

        // 为 DirectoryRepository 类建立预言(prophecy)。
        $repository = $this->prophesize(DirectoryRepository::class);
        // 建立预期状况:export() 方法将会被调用一次。
        $repository->export($stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());

        $result = $stub->export();

        $this->assertTrue($result);
    }
}
