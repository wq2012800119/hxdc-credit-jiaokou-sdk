<?php
namespace Sdk\Resource\UploadDataTask\Model;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\Resource\Directory\Model\DirectorySnapshot;
use Sdk\Organization\Organization\Model\Organization;
use Sdk\Resource\UploadDataTask\Repository\UploadDataTaskRepository;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class UploadDataTaskTest extends TestCase
{
    private $uploadDataTaskStub;

    protected function setUp(): void
    {
        $this->uploadDataTaskStub = new UploadDataTask();
    }

    protected function tearDown(): void
    {
        unset($this->uploadDataTaskStub);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->uploadDataTaskStub
        );
    }

    public function testImplementsIOperateAble()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Model\Interfaces\IOperateAble',
            $this->uploadDataTaskStub
        );
    }

    /**
     * UploadDataTask 领域对象,测试构造函数
     */
    public function testUploadDataTaskConstructor()
    {
        $this->assertEmpty($this->uploadDataTaskStub->getId());
        $this->assertEmpty($this->uploadDataTaskStub->getName());
        $this->assertEmpty($this->uploadDataTaskStub->getExportFileName());
        $this->assertEmpty($this->uploadDataTaskStub->getTotal());
        $this->assertEmpty($this->uploadDataTaskStub->getSuccessNum());
        $this->assertEmpty($this->uploadDataTaskStub->getFailNum());
        $this->assertEmpty($this->uploadDataTaskStub->getUpdatedNum());
        $this->assertEmpty($this->uploadDataTaskStub->getExecutionStatus());
        $this->assertEmpty($this->uploadDataTaskStub->getCode());
        $this->assertEmpty($this->uploadDataTaskStub->getStatus());
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\Organization',
            $this->uploadDataTaskStub->getOrganization()
        );
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\Staff',
            $this->uploadDataTaskStub->getStaff()
        );
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\Directory',
            $this->uploadDataTaskStub->getDirectory()
        );
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\DirectorySnapshot',
            $this->uploadDataTaskStub->getDirectorySnapshot()
        );
        $this->assertEmpty($this->uploadDataTaskStub->getCreateTime());
        $this->assertEmpty($this->uploadDataTaskStub->getUpdateTime());
        $this->assertEmpty($this->uploadDataTaskStub->getStatusTime());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 UploadDataTask setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->uploadDataTaskStub->setId(1);
        $this->assertEquals(1, $this->uploadDataTaskStub->getId());
    }

    /**
     * 设置 UploadDataTask setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->uploadDataTaskStub->setId('1');
        $this->assertTrue(is_int($this->uploadDataTaskStub->getId()));
        $this->assertEquals(1, $this->uploadDataTaskStub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //name 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTask setName() 正确的传参类型,期望传值正确
     */
    public function testSetNameCorrectType()
    {
        $this->uploadDataTaskStub->setName('uploadDataTaskName');
        $this->assertEquals('uploadDataTaskName', $this->uploadDataTaskStub->getName());
    }

    /**
     * 设置 UploadDataTask setName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetNameWrongType()
    {
        $this->uploadDataTaskStub->setName(array('uploadDataTaskName'));
    }
    //name 测试 --------------------------------------------------------   end

    //exportFileName 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTask setExportFileName() 正确的传参类型,期望传值正确
     */
    public function testSetExportFileNameCorrectType()
    {
        $this->uploadDataTaskStub->setExportFileName('exportFileName');
        $this->assertEquals('exportFileName', $this->uploadDataTaskStub->getExportFileName());
    }

    /**
     * 设置 UploadDataTask setExportFileName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetExportFileNameWrongType()
    {
        $this->uploadDataTaskStub->setExportFileName(array('exportFileName'));
    }
    //exportFileName 测试 --------------------------------------------------------   end

    //total 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTask setTotal() 正确的传参类型,期望传值正确
     */
    public function testSetTotalCorrectType()
    {
        $this->uploadDataTaskStub->setTotal(3);
        $this->assertEquals(3, $this->uploadDataTaskStub->getTotal());
    }

    /**
     * 设置 UploadDataTask setTotal() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetTotalWrongType()
    {
        $this->uploadDataTaskStub->setTotal(array('total'));
    }
    //total 测试 --------------------------------------------------------   end

    //successNum 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTask setSuccessNum() 正确的传参类型,期望传值正确
     */
    public function testSetSuccessNumCorrectType()
    {
        $this->uploadDataTaskStub->setSuccessNum(3);
        $this->assertEquals(3, $this->uploadDataTaskStub->getSuccessNum());
    }

    /**
     * 设置 UploadDataTask setSuccessNum() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSuccessNumWrongType()
    {
        $this->uploadDataTaskStub->setSuccessNum(array('successNum'));
    }
    //successNum 测试 --------------------------------------------------------   end

    //failNum 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTask setFailNum() 正确的传参类型,期望传值正确
     */
    public function testSetFailNumCorrectType()
    {
        $this->uploadDataTaskStub->setFailNum(3);
        $this->assertEquals(3, $this->uploadDataTaskStub->getFailNum());
    }

    /**
     * 设置 UploadDataTask setFailNum() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetFailNumWrongType()
    {
        $this->uploadDataTaskStub->setFailNum(array('failNum'));
    }
    //failNum 测试 --------------------------------------------------------   end

    //updatedNum 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTask setUpdatedNum() 正确的传参类型,期望传值正确
     */
    public function testSetUpdatedNumCorrectType()
    {
        $this->uploadDataTaskStub->setUpdatedNum(3);
        $this->assertEquals(3, $this->uploadDataTaskStub->getUpdatedNum());
    }

    /**
     * 设置 UploadDataTask setUpdatedNum() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetUpdatedNumWrongType()
    {
        $this->uploadDataTaskStub->setUpdatedNum(array('updatedNum'));
    }
    //updatedNum 测试 --------------------------------------------------------   end

    //executionStatus 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTask setExecutionStatus() 正确的传参类型,期望传值正确
     */
    public function testSetExecutionStatusCorrectType()
    {
        $this->uploadDataTaskStub->setExecutionStatus(3);
        $this->assertEquals(3, $this->uploadDataTaskStub->getExecutionStatus());
    }

    /**
     * 设置 UploadDataTask setExecutionStatus() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetExecutionStatusWrongType()
    {
        $this->uploadDataTaskStub->setExecutionStatus(array('executionStatus'));
    }
    //executionStatus 测试 --------------------------------------------------------   end

    //organization 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTask setOrganization() 正确的传参类型,期望传值正确
     */
    public function testSetOrganizationCorrectType()
    {
        $organization = new Organization();
        $this->uploadDataTaskStub->setOrganization($organization);
        $this->assertEquals($organization, $this->uploadDataTaskStub->getOrganization());
    }

    /**
     * 设置 UploadDataTask setOrganization() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetOrganizationWrongType()
    {
        $this->uploadDataTaskStub->setOrganization(array('organization'));
    }
    //organization 测试 --------------------------------------------------------   end

    //code 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTask setCode() 正确的传参类型,期望传值正确
     */
    public function testSetCodeCorrectType()
    {
        $this->uploadDataTaskStub->setCode(3);
        $this->assertEquals(3, $this->uploadDataTaskStub->getCode());
    }

    /**
     * 设置 UploadDataTask setCode() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetCodeWrongType()
    {
        $this->uploadDataTaskStub->setCode(array('code'));
    }
    //code 测试 --------------------------------------------------------   end

    //directory 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTask setDirectory() 正确的传参类型,期望传值正确
     */
    public function testSetDirectoryCorrectType()
    {
        $directory = new Directory();
        $this->uploadDataTaskStub->setDirectory($directory);
        $this->assertEquals($directory, $this->uploadDataTaskStub->getDirectory());
    }

    /**
     * 设置 UploadDataTask setDirectory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDirectoryWrongType()
    {
        $this->uploadDataTaskStub->setDirectory(array('directory'));
    }
    //directory 测试 --------------------------------------------------------   end

    //directorySnapshot 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTask setDirectorySnapshot() 正确的传参类型,期望传值正确
     */
    public function testSetDirectorySnapshotCorrectType()
    {
        $directorySnapshot = new DirectorySnapshot();
        $this->uploadDataTaskStub->setDirectorySnapshot($directorySnapshot);
        $this->assertEquals($directorySnapshot, $this->uploadDataTaskStub->getDirectorySnapshot());
    }

    /**
     * 设置 UploadDataTask setDirectorySnapshot() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDirectorySnapshotWrongType()
    {
        $this->uploadDataTaskStub->setDirectorySnapshot(array('directorySnapshot'));
    }
    //directorySnapshot 测试 --------------------------------------------------------   end

    //staff 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTask setStaff() 正确的传参类型,期望传值正确
     */
    public function testSetStaffCorrectType()
    {
        $staff = new OrganizationUserStaff();
        $this->uploadDataTaskStub->setStaff($staff);
        $this->assertEquals($staff, $this->uploadDataTaskStub->getStaff());
    }

    /**
     * 设置 UploadDataTask setStaff() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStaffWrongType()
    {
        $this->uploadDataTaskStub->setStaff(array('staff'));
    }
    //staff 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $uploadDataTaskStub = new UploadDataTaskMock();
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Repository\UploadDataTaskRepository',
            $uploadDataTaskStub->getRepositoryPublic()
        );
    }
}
