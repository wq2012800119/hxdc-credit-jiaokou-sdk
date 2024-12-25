<?php
namespace Sdk\Resource\Data\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\Organization\Organization\Model\Organization;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\Resource\Directory\Model\DirectorySnapshot;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DataTest extends TestCase
{
    private $dataStub;

    protected function setUp(): void
    {
        $this->dataStub = new Data();
    }

    protected function tearDown(): void
    {
        unset($this->dataStub);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->dataStub
        );
    }

    public function testImplementsIOperateAble()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Model\Interfaces\IOperateAble',
            $this->dataStub
        );
    }

    public function testImplementsIExamineAble()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Model\Interfaces\IExamineAble',
            $this->dataStub
        );
    }
    /**
     * Data 领域对象,测试构造函数
     */
    public function testDataConstructor()
    {
        $this->assertEmpty($this->dataStub->getId());
        $this->assertEmpty($this->dataStub->getSubjectName());
        $this->assertEmpty($this->dataStub->getIdentify());
        $this->assertEmpty($this->dataStub->getSubjectCategory());
        $this->assertEmpty($this->dataStub->getInfoCategory());
        $this->assertEmpty($this->dataStub->getPublicationRange());
        $this->assertEmpty($this->dataStub->getExpireDate());
        $this->assertEmpty($this->dataStub->getItems());
        $this->assertEmpty($this->dataStub->getExchangeSyncStatus());
        $this->assertEmpty($this->dataStub->getInternalSyncStatus());
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\Organization',
            $this->dataStub->getOrganization()
        );
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\Staff',
            $this->dataStub->getStaff()
        );
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\Directory',
            $this->dataStub->getDirectory()
        );
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\DirectorySnapshot',
            $this->dataStub->getDirectorySnapshot()
        );
        $this->assertEquals(Data::EXAMINE_STATUS['PENDING'], $this->dataStub->getExamineStatus());
        $this->assertEquals(Data::STATUS['ENABLED'], $this->dataStub->getStatus());
        $this->assertEmpty($this->dataStub->getCreateTime());
        $this->assertEmpty($this->dataStub->getUpdateTime());
        $this->assertEmpty($this->dataStub->getStatusTime());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 Data setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->dataStub->setId(1);
        $this->assertEquals(1, $this->dataStub->getId());
    }

    /**
     * 设置 Data setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->dataStub->setId('1');
        $this->assertTrue(is_int($this->dataStub->getId()));
        $this->assertEquals(1, $this->dataStub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //subjectName 测试 -------------------------------------------------------- start
    /**
     * 设置 Data setSubjectName() 正确的传参类型,期望传值正确
     */
    public function testSetSubjectNameCorrectType()
    {
        $this->dataStub->setSubjectName('dataSubjectName');
        $this->assertEquals('dataSubjectName', $this->dataStub->getSubjectName());
    }

    /**
     * 设置 Data setSubjectName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSubjectNameWrongType()
    {
        $this->dataStub->setSubjectName(array('dataSubjectName'));
    }
    //subjectName 测试 --------------------------------------------------------   end

    //identify 测试 -------------------------------------------------------- start
    /**
     * 设置 Data setIdentify() 正确的传参类型,期望传值正确
     */
    public function testSetIdentifyCorrectType()
    {
        $this->dataStub->setIdentify('identify');
        $this->assertEquals('identify', $this->dataStub->getIdentify());
    }

    /**
     * 设置 Data setIdentify() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetIdentifyWrongType()
    {
        $this->dataStub->setIdentify(array('identify'));
    }
    //identify 测试 --------------------------------------------------------   end

    //subjectCategory 测试 -------------------------------------------------------- start
    /**
     * 设置 Data setSubjectCategory() 正确的传参类型,期望传值正确
     */
    public function testSetSubjectCategoryCorrectType()
    {
        $this->dataStub->setSubjectCategory(1);
        $this->assertEquals(1, $this->dataStub->getSubjectCategory());
    }

    /**
     * 设置 Data setSubjectCategory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSubjectCategoryWrongType()
    {
        $this->dataStub->setSubjectCategory('subjectCategory');
    }
    //subjectCategory 测试 --------------------------------------------------------   end

    //infoCategory 测试 -------------------------------------------------------- start
    /**
     * 设置 Data setInfoCategory() 正确的传参类型,期望传值正确
     */
    public function testSetInfoCategoryCorrectType()
    {
        $this->dataStub->setInfoCategory(1);
        $this->assertEquals(1, $this->dataStub->getInfoCategory());
    }

    /**
     * 设置 Data setInfoCategory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetInfoCategoryWrongType()
    {
        $this->dataStub->setInfoCategory(array('infoCategory'));
    }
    //infoCategory 测试 --------------------------------------------------------   end

    //publicationRange 测试 -------------------------------------------------------- start
    /**
     * 设置 Data setPublicationRange() 正确的传参类型,期望传值正确
     */
    public function testSetPublicationRangeCorrectType()
    {
        $this->dataStub->setPublicationRange(1);
        $this->assertEquals(1, $this->dataStub->getPublicationRange());
    }

    /**
     * 设置 Data setPublicationRange() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetPublicationRangeWrongType()
    {
        $this->dataStub->setPublicationRange(array('publicationRange'));
    }
    //publicationRange 测试 --------------------------------------------------------   end

    //expireDate 测试 -------------------------------------------------------- start
    /**
     * 设置 Data setExpireDate() 正确的传参类型,期望传值正确
     */
    public function testSetExpireDateCorrectType()
    {
        $this->dataStub->setExpireDate(1);
        $this->assertEquals(1, $this->dataStub->getExpireDate());
    }

    /**
     * 设置 Data setExpireDate() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetExpireDateWrongType()
    {
        $this->dataStub->setExpireDate(array('expireDate'));
    }
    //expireDate 测试 --------------------------------------------------------   end

    //exchangeSyncStatus 测试 -------------------------------------------------------- start
    /**
     * 设置 Data setExchangeSyncStatus() 正确的传参类型,期望传值正确
     */
    public function testSetExchangeSyncStatusCorrectType()
    {
        $this->dataStub->setExchangeSyncStatus(1);
        $this->assertEquals(1, $this->dataStub->getExchangeSyncStatus());
    }

    /**
     * 设置 Data setExchangeSyncStatus() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetExchangeSyncStatusWrongType()
    {
        $this->dataStub->setExchangeSyncStatus(array('exchangeSyncStatus'));
    }
    //exchangeSyncStatus 测试 --------------------------------------------------------   end

    //internalSyncStatus 测试 -------------------------------------------------------- start
    /**
     * 设置 Data setInternalSyncStatus() 正确的传参类型,期望传值正确
     */
    public function testSetInternalSyncStatusCorrectType()
    {
        $this->dataStub->setInternalSyncStatus(1);
        $this->assertEquals(1, $this->dataStub->getInternalSyncStatus());
    }

    /**
     * 设置 Data setInternalSyncStatus() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetInternalSyncStatusWrongType()
    {
        $this->dataStub->setInternalSyncStatus(array('internalSyncStatus'));
    }
    //internalSyncStatus 测试 --------------------------------------------------------   end

    //items 测试 -------------------------------------------------------- start
    /**
     * 设置 Data setItems() 正确的传参类型,期望传值正确
     */
    public function testSetItemsCorrectType()
    {
        $this->dataStub->setItems(array('items'));
        $this->assertEquals(array('items'), $this->dataStub->getItems());
    }

    /**
     * 设置 Data setItems() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetItemsWrongType()
    {
        $this->dataStub->setItems('items');
    }
    //items 测试 --------------------------------------------------------   end
    
    //organization 测试 -------------------------------------------------------- start
    /**
     * 设置 Data setOrganization() 正确的传参类型,期望传值正确
     */
    public function testSetOrganizationCorrectType()
    {
        $organization = new Organization();
        $this->dataStub->setOrganization($organization);
        $this->assertEquals($organization, $this->dataStub->getOrganization());
    }

    /**
     * 设置 Data setOrganization() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetOrganizationWrongType()
    {
        $this->dataStub->setOrganization(array('organization'));
    }
    //organization 测试 --------------------------------------------------------   end

    //staff 测试 -------------------------------------------------------- start
    /**
     * 设置 Data setStaff() 正确的传参类型,期望传值正确
     */
    public function testSetStaffCorrectType()
    {
        $staff = new OrganizationUserStaff();
        $this->dataStub->setStaff($staff);
        $this->assertEquals($staff, $this->dataStub->getStaff());
    }

    /**
     * 设置 Data setStaff() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStaffWrongType()
    {
        $this->dataStub->setStaff(array('staff'));
    }
    //staff 测试 --------------------------------------------------------   end

    //directory 测试 -------------------------------------------------------- start
    /**
     * 设置 Data setDirectory() 正确的传参类型,期望传值正确
     */
    public function testSetDirectoryCorrectType()
    {
        $directory = new Directory();
        $this->dataStub->setDirectory($directory);
        $this->assertEquals($directory, $this->dataStub->getDirectory());
    }

    /**
     * 设置 Data setDirectory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDirectoryWrongType()
    {
        $this->dataStub->setDirectory(array('directory'));
    }
    //directory 测试 --------------------------------------------------------   end

    //directorySnapshot 测试 -------------------------------------------------------- start
    /**
     * 设置 Data setDirectorySnapshot() 正确的传参类型,期望传值正确
     */
    public function testSetDirectorySnapshotCorrectType()
    {
        $directorySnapshot = new DirectorySnapshot();
        $this->dataStub->setDirectorySnapshot($directorySnapshot);
        $this->assertEquals($directorySnapshot, $this->dataStub->getDirectorySnapshot());
    }

    /**
     * 设置 Data setDirectorySnapshot() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDirectorySnapshotWrongType()
    {
        $this->dataStub->setDirectorySnapshot(array('directorySnapshot'));
    }
    //directorySnapshot 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $dataStub = new DataMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Data\Repository\DataRepository',
            $dataStub->getRepositoryPublic()
        );
    }

    public function testUpdate()
    {
        $this->assertFalse($this->dataStub->update());
        $this->assertEquals(METHOD_NOT_ALLOWED, Core::getLastError()->getId());
    }
}
