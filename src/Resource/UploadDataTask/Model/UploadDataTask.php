<?php
namespace Sdk\Resource\UploadDataTask\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Resource\UploadDataTask\Repository\UploadDataTaskRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\Organization\Organization\Model\Organization;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\Resource\Directory\Model\DirectorySnapshot;

class UploadDataTask implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;
    
    /**
     * 任务执行状态
     * NOT_STARTED 未开始
     * EXECUTION 正在执行
     * COMPLETED 执行完成
     * FAILED 执行失败
     */
    const EXECUTION_STATUS = array(
        'NOT_STARTED' => 0,
        'EXECUTION' => 1,
        'COMPLETED' => 2,
        'FAILED' => -2
    );

    const EXECUTION_STATUS_CN = array(
        self::EXECUTION_STATUS['NOT_STARTED'] => '未开始',
        self::EXECUTION_STATUS['EXECUTION'] => '正在执行',
        self::EXECUTION_STATUS['COMPLETED'] => '执行完成',
        self::EXECUTION_STATUS['FAILED'] => '执行失败'
    );
 
    const EXECUTION_STATUS_TYPE = array(
        self::EXECUTION_STATUS['NOT_STARTED'] => 'warning',
        self::EXECUTION_STATUS['EXECUTION'] => 'warning',
        self::EXECUTION_STATUS['COMPLETED'] => 'success',
        self::EXECUTION_STATUS['FAILED'] => 'danger'
    );

    /**
     * 任务状态
     * NULL 默认
     * SUCCESS 成功
     * FAILED 失败
     */
    const TASK_STATUS = array(
        'NULL' => 0,
        'SUCCESS' => 2,
        'FAILED' => -2
    );

    const TASK_STATUS_CN = array(
        self::TASK_STATUS['NULL'] => '未执行完成',
        self::TASK_STATUS['SUCCESS'] => '成功',
        self::TASK_STATUS['FAILED'] => '失败',
    );
        
    const TASK_STATUS_TYPE = array(
        self::TASK_STATUS['NULL'] => 'warning',
        self::TASK_STATUS['SUCCESS'] => 'success',
        self::TASK_STATUS['FAILED'] => 'danger'
    );

    /**
     * 执行失败-状态码
     * NULL 未定义
     * REPEAT 任务重复
     * LIMIT_EXCEEDED 任务超过最大上传数量
     */
    const CODE = array(
        'NULL' => 0,
        'REPEAT' => -1,
        'LIMIT_EXCEEDED' => -2
    );

    const CODE_CN = array(
        self::CODE['NULL'] => '未定义',
        self::CODE['REPEAT'] => '任务重复',
        self::CODE['LIMIT_EXCEEDED'] => '任务超过最大上传数量'
    );

    private $id;
    /**
     * @var string $name 上传文件名
     */
    private $name;
    /**
     * @var string $exportFileName 失败文件名
     */
    private $exportFileName;
    /**
     * @var int $total 总数
     */
    private $total;
    /**
     * @var int $successNum 成功数
     */
    private $successNum;
    /**
     * @var int $failNum 失败数
     */
    private $failNum;
    /**
     * @var int $updatedNum 任务在执行期间已同步数据量
     */
    private $updatedNum;
    /**
     * @var string $executionStatus 执行状态
     */
    private $executionStatus;
    /**
     * @var int $code 执行失败状态码
     */
    private $code;
    /**
     * @var Organization $organization 发布委办局
     */
    private $organization;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    /**
     * @var Directory $directory 目录
     */
    private $directory;
    /**
     * @var DirectorySnapshot $directorySnapshot 目录快照
     */
    private $directorySnapshot;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->name = '';
        $this->exportFileName = '';
        $this->total = 0;
        $this->successNum = 0;
        $this->failNum = 0;
        $this->updatedNum = 0;
        $this->executionStatus = 0;
        $this->code = 0;
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->directory = new Directory();
        $this->directorySnapshot = new DirectorySnapshot();
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new UploadDataTaskRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->exportFileName);
        unset($this->total);
        unset($this->successNum);
        unset($this->failNum);
        unset($this->updatedNum);
        unset($this->executionStatus);
        unset($this->code);
        unset($this->organization);
        unset($this->staff);
        unset($this->directory);
        unset($this->directorySnapshot);
        unset($this->status);
        unset($this->createTime);
        unset($this->updateTime);
        unset($this->statusTime);
        unset($this->repository);
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setExportFileName(string $exportFileName): void
    {
        $this->exportFileName = $exportFileName;
    }

    public function getExportFileName(): string
    {
        return $this->exportFileName;
    }

    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setSuccessNum(int $successNum): void
    {
        $this->successNum = $successNum;
    }

    public function getSuccessNum(): int
    {
        return $this->successNum;
    }

    public function setFailNum(int $failNum): void
    {
        $this->failNum = $failNum;
    }

    public function getFailNum(): int
    {
        return $this->failNum;
    }

    public function setUpdatedNum(int $updatedNum): void
    {
        $this->updatedNum = $updatedNum;
    }

    public function getUpdatedNum(): int
    {
        return $this->updatedNum;
    }

    public function setExecutionStatus(int $executionStatus): void
    {
        $this->executionStatus = $executionStatus;
    }

    public function getExecutionStatus(): int
    {
        return $this->executionStatus;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setDirectory(Directory $directory): void
    {
        $this->directory = $directory;
    }

    public function getDirectory(): Directory
    {
        return $this->directory;
    }
    
    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    public function setDirectorySnapshot(DirectorySnapshot $directorySnapshot): void
    {
        $this->directorySnapshot = $directorySnapshot;
    }

    public function getDirectorySnapshot(): DirectorySnapshot
    {
        return $this->directorySnapshot;
    }
    
    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    protected function getRepository() : UploadDataTaskRepository
    {
        return $this->repository;
    }
}
