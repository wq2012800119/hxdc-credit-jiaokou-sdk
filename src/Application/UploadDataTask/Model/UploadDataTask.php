<?php
namespace Sdk\Application\UploadDataTask\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Application\UploadDataTask\Repository\UploadDataTaskRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\Organization\Organization\Model\Organization;

class UploadDataTask implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;
    
    /**
     * 数据导入类型
     * COMMITMENT 信用承诺
     * CONTRACT_PERFORMANCE 合同履约
     */
    const CATEGORY = array(
        'COMMITMENT' => 4,
        'CONTRACT_PERFORMANCE' => 6
    );

    const CATEGORY_CN = array(
        self::CATEGORY['COMMITMENT'] => '信用承诺',
        self::CATEGORY['CONTRACT_PERFORMANCE'] => '合同履约'
    );

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

    const EXECUTION_STATUS_TYPE = array(
        self::EXECUTION_STATUS['NOT_STARTED'] => 'warning',
        self::EXECUTION_STATUS['EXECUTION'] => 'warning',
        self::EXECUTION_STATUS['COMPLETED'] => 'success',
        self::EXECUTION_STATUS['FAILED'] => 'danger'
    );

    const EXECUTION_STATUS_CN = array(
        self::EXECUTION_STATUS['NOT_STARTED'] => '未开始',
        self::EXECUTION_STATUS['EXECUTION'] => '正在执行',
        self::EXECUTION_STATUS['COMPLETED'] => '执行完成',
        self::EXECUTION_STATUS['FAILED'] => '执行失败'
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

    const TASK_STATUS_TYPE = array(
        self::TASK_STATUS['NULL'] => 'warning',
        self::TASK_STATUS['SUCCESS'] => 'success',
        self::TASK_STATUS['FAILED'] => 'danger'
    );

    const TASK_STATUS_CN = array(
        self::TASK_STATUS['NULL'] => '未执行完成',
        self::TASK_STATUS['SUCCESS'] => '成功',
        self::TASK_STATUS['FAILED'] => '失败',
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
     * @var int $category 类型
     */
    private $category;
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
     * @var int $code 执行失败状态码
     */
    private $code;
    /**
     * @var string $executionStatus 执行状态
     */
    private $executionStatus;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    /**
     * @var Organization $organization 发布委办局
     */
    private $organization;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->total = 0;
        $this->successNum = 0;
        $this->failNum = 0;
        $this->updatedNum = 0;
        $this->executionStatus = 0;
        $this->code = 0;
        $this->name = '';
        $this->exportFileName = '';
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->category = 0;
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
        unset($this->updatedNum);
        unset($this->code);
        unset($this->total);
        unset($this->failNum);
        unset($this->successNum);
        unset($this->executionStatus);
        unset($this->exportFileName);
        unset($this->organization);
        unset($this->staff);
        unset($this->category);
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

    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    public function getCategory(): int
    {
        return $this->category;
    }
    
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
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

    public function setExportFileName(string $exportFileName): void
    {
        $this->exportFileName = $exportFileName;
    }

    public function getExportFileName(): string
    {
        return $this->exportFileName;
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
    
    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
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
