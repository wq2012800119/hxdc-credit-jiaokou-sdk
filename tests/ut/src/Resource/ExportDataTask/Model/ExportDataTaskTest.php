<?php
namespace Sdk\Resource\ExportDataTask\Model;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\Resource\Directory\Model\DirectorySnapshot;
use Sdk\Organization\Organization\Model\Organization;
use Sdk\Resource\ExportDataTask\Repository\ExportDataTaskRepository;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ExportDataTaskTest extends TestCase
{
    private $exportDataTaskStub;

    protected function setUp(): void
    {
        $this->exportDataTaskStub = new ExportDataTask();
    }

    protected function tearDown(): void
    {
        unset($this->exportDataTaskStub);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->exportDataTaskStub
        );
    }

    public function testImplementsIOperateAble()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Model\Interfaces\IOperateAble',
            $this->exportDataTaskStub
        );
    }

    /**
     * ExportDataTask 领域对象,测试构造函数
     */
    public function testExportDataTaskConstructor()
    {
        $this->assertEmpty($this->exportDataTaskStub->getId());
        $this->assertEmpty($this->exportDataTaskStub->getExportFileName());
        $this->assertEmpty($this->exportDataTaskStub->getTotal());
        $this->assertEmpty($this->exportDataTaskStub->getSize());
        $this->assertEmpty($this->exportDataTaskStub->getOffset());
        $this->assertEmpty($this->exportDataTaskStub->getFilter());
        $this->assertEmpty($this->exportDataTaskStub->getSort());
        $this->assertEmpty($this->exportDataTaskStub->getUpdatedNum());
        $this->assertEmpty($this->exportDataTaskStub->getCode());
        $this->assertEmpty($this->exportDataTaskStub->getStatus());
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Model\Organization',
            $this->exportDataTaskStub->getOrganization()
        );
        $this->assertInstanceOf(
            'Sdk\User\Staff\Model\Staff',
            $this->exportDataTaskStub->getStaff()
        );
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\Directory',
            $this->exportDataTaskStub->getDirectory()
        );
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\DirectorySnapshot',
            $this->exportDataTaskStub->getDirectorySnapshot()
        );
        $this->assertEmpty($this->exportDataTaskStub->getCreateTime());
        $this->assertEmpty($this->exportDataTaskStub->getUpdateTime());
        $this->assertEmpty($this->exportDataTaskStub->getStatusTime());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 ExportDataTask setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->exportDataTaskStub->setId(1);
        $this->assertEquals(1, $this->exportDataTaskStub->getId());
    }

    /**
     * 设置 ExportDataTask setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->exportDataTaskStub->setId('1');
        $this->assertTrue(is_int($this->exportDataTaskStub->getId()));
        $this->assertEquals(1, $this->exportDataTaskStub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //exportFileName 测试 -------------------------------------------------------- start
    /**
     * 设置 ExportDataTask setExportFileName() 正确的传参类型,期望传值正确
     */
    public function testSetExportFileNameCorrectType()
    {
        $this->exportDataTaskStub->setExportFileName('exportFileName');
        $this->assertEquals('exportFileName', $this->exportDataTaskStub->getExportFileName());
    }

    /**
     * 设置 ExportDataTask setExportFileName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetExportFileNameWrongType()
    {
        $this->exportDataTaskStub->setExportFileName(array('exportFileName'));
    }
    //exportFileName 测试 --------------------------------------------------------   end

    //total 测试 -------------------------------------------------------- start
    /**
     * 设置 ExportDataTask setTotal() 正确的传参类型,期望传值正确
     */
    public function testSetTotalCorrectType()
    {
        $this->exportDataTaskStub->setTotal(3);
        $this->assertEquals(3, $this->exportDataTaskStub->getTotal());
    }

    /**
     * 设置 ExportDataTask setTotal() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetTotalWrongType()
    {
        $this->exportDataTaskStub->setTotal(array('total'));
    }
    //total 测试 --------------------------------------------------------   end

    //size 测试 -------------------------------------------------------- start
    /**
     * 设置 ExportDataTask setSize() 正确的传参类型,期望传值正确
     */
    public function testSetSizeCorrectType()
    {
        $this->exportDataTaskStub->setSize(3);
        $this->assertEquals(3, $this->exportDataTaskStub->getSize());
    }

    /**
     * 设置 ExportDataTask setSize() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSizeWrongType()
    {
        $this->exportDataTaskStub->setSize(array('size'));
    }
    //size 测试 --------------------------------------------------------   end

    //offset 测试 -------------------------------------------------------- start
    /**
     * 设置 ExportDataTask setOffset() 正确的传参类型,期望传值正确
     */
    public function testSetOffsetCorrectType()
    {
        $this->exportDataTaskStub->setOffset(3);
        $this->assertEquals(3, $this->exportDataTaskStub->getOffset());
    }

    /**
     * 设置 ExportDataTask setOffset() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetOffsetWrongType()
    {
        $this->exportDataTaskStub->setOffset(array('offset'));
    }
    //offset 测试 --------------------------------------------------------   end

    //filter 测试 -------------------------------------------------------- start
    /**
     * 设置 ExportDataTask setFilter() 正确的传参类型,期望传值正确
     */
    public function testSetFilterCorrectType()
    {
        $this->exportDataTaskStub->setFilter(array('filter'));
        $this->assertEquals(array('filter'), $this->exportDataTaskStub->getFilter());
    }

    /**
     * 设置 ExportDataTask setFilter() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetFilterWrongType()
    {
        $this->exportDataTaskStub->setFilter(3);
    }
    //filter 测试 --------------------------------------------------------   end

    //sort 测试 -------------------------------------------------------- start
    /**
     * 设置 ExportDataTask setSort() 正确的传参类型,期望传值正确
     */
    public function testSetSortCorrectType()
    {
        $this->exportDataTaskStub->setSort('sort');
        $this->assertEquals('sort', $this->exportDataTaskStub->getSort());
    }

    /**
     * 设置 ExportDataTask setSort() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSortWrongType()
    {
        $this->exportDataTaskStub->setSort(array('sort'));
    }
    //sort 测试 --------------------------------------------------------   end

    //updatedNum 测试 -------------------------------------------------------- start
    /**
     * 设置 ExportDataTask setUpdatedNum() 正确的传参类型,期望传值正确
     */
    public function testSetUpdatedNumCorrectType()
    {
        $this->exportDataTaskStub->setUpdatedNum(3);
        $this->assertEquals(3, $this->exportDataTaskStub->getUpdatedNum());
    }

    /**
     * 设置 ExportDataTask setUpdatedNum() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetUpdatedNumWrongType()
    {
        $this->exportDataTaskStub->setUpdatedNum(array('updatedNum'));
    }
    //updatedNum 测试 --------------------------------------------------------   end

    //organization 测试 -------------------------------------------------------- start
    /**
     * 设置 ExportDataTask setOrganization() 正确的传参类型,期望传值正确
     */
    public function testSetOrganizationCorrectType()
    {
        $organization = new Organization();
        $this->exportDataTaskStub->setOrganization($organization);
        $this->assertEquals($organization, $this->exportDataTaskStub->getOrganization());
    }

    /**
     * 设置 ExportDataTask setOrganization() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetOrganizationWrongType()
    {
        $this->exportDataTaskStub->setOrganization(array('organization'));
    }
    //organization 测试 --------------------------------------------------------   end

    //code 测试 -------------------------------------------------------- start
    /**
     * 设置 ExportDataTask setCode() 正确的传参类型,期望传值正确
     */
    public function testSetCodeCorrectType()
    {
        $this->exportDataTaskStub->setCode(3);
        $this->assertEquals(3, $this->exportDataTaskStub->getCode());
    }

    /**
     * 设置 ExportDataTask setCode() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetCodeWrongType()
    {
        $this->exportDataTaskStub->setCode(array('code'));
    }
    //code 测试 --------------------------------------------------------   end

    //directory 测试 -------------------------------------------------------- start
    /**
     * 设置 ExportDataTask setDirectory() 正确的传参类型,期望传值正确
     */
    public function testSetDirectoryCorrectType()
    {
        $directory = new Directory();
        $this->exportDataTaskStub->setDirectory($directory);
        $this->assertEquals($directory, $this->exportDataTaskStub->getDirectory());
    }

    /**
     * 设置 ExportDataTask setDirectory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDirectoryWrongType()
    {
        $this->exportDataTaskStub->setDirectory(array('directory'));
    }
    //directory 测试 --------------------------------------------------------   end

    //directorySnapshot 测试 -------------------------------------------------------- start
    /**
     * 设置 ExportDataTask setDirectorySnapshot() 正确的传参类型,期望传值正确
     */
    public function testSetDirectorySnapshotCorrectType()
    {
        $directorySnapshot = new DirectorySnapshot();
        $this->exportDataTaskStub->setDirectorySnapshot($directorySnapshot);
        $this->assertEquals($directorySnapshot, $this->exportDataTaskStub->getDirectorySnapshot());
    }

    /**
     * 设置 ExportDataTask setDirectorySnapshot() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDirectorySnapshotWrongType()
    {
        $this->exportDataTaskStub->setDirectorySnapshot(array('directorySnapshot'));
    }
    //directorySnapshot 测试 --------------------------------------------------------   end

    //staff 测试 -------------------------------------------------------- start
    /**
     * 设置 ExportDataTask setStaff() 正确的传参类型,期望传值正确
     */
    public function testSetStaffCorrectType()
    {
        $staff = new OrganizationUserStaff();
        $this->exportDataTaskStub->setStaff($staff);
        $this->assertEquals($staff, $this->exportDataTaskStub->getStaff());
    }

    /**
     * 设置 ExportDataTask setStaff() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStaffWrongType()
    {
        $this->exportDataTaskStub->setStaff(array('staff'));
    }
    //staff 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $exportDataTaskStub = new ExportDataTaskMock();
        $this->assertInstanceOf(
            'Sdk\Resource\ExportDataTask\Repository\ExportDataTaskRepository',
            $exportDataTaskStub->getRepositoryPublic()
        );
    }
}
