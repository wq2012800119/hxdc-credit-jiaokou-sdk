<?php
namespace Sdk\Application\ExportDataTask\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Application\ExportDataTask\Repository\ExportDataTaskRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\Organization\Organization\Model\Organization;

class ExportDataTask implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;
    
    /**
     * 执行失败-状态码
     * NULL 未定义
     * FAILED 导出失败
     * DATA_EMPTY 导出数据为空
     */
    const CODE = array(
        'NULL' => 0,
        'FAILED' => 100671,
        'DATA_EMPTY' => 100675
    );

    const CODE_CN = array(
        self::CODE['NULL'] => '未定义',
        self::CODE['FAILED'] => '导出失败',
        self::CODE['DATA_EMPTY'] => '导出数据为空'
    );

    /**
     * 数据导出类型
     * RAP_CASES 联合奖惩案例
     * COMMITMENT 信用承诺
     * CONTRACT_PERFORMANCE 合同履约
     * APPLICATION_LOG 日志
     */
    const CATEGORY = array(
        'RAP_CASES' => 2,
        'COMMITMENT' => 4,
        'CONTRACT_PERFORMANCE' => 6,
        'APPLICATION_LOG' => 8
    );

    const CATEGORY_CN = array(
        self::CATEGORY['RAP_CASES'] => '联合奖惩案例',
        self::CATEGORY['COMMITMENT'] => '信用承诺',
        self::CATEGORY['CONTRACT_PERFORMANCE'] => '合同履约',
        self::CATEGORY['APPLICATION_LOG'] => '日志',
    );

    /**
     * 任务执行状态
     * NOT_STARTED 未开始
     * EXECUTION 正在执行
     * COMPLETED 执行完成
     * FAILED 执行失败
     */
    const TASK_STATUS = array(
        'NOT_STARTED' => 0,
        'EXECUTION' => 1,
        'COMPLETED' => 2,
        'FAILED' => -2
    );

    const TASK_STATUS_CN = array(
        self::TASK_STATUS['NOT_STARTED'] => '未开始',
        self::TASK_STATUS['EXECUTION'] => '正在执行',
        self::TASK_STATUS['COMPLETED'] => '执行完成',
        self::TASK_STATUS['FAILED'] => '执行失败'
    );
 
    const TASK_STATUS_TYPE = array(
        self::TASK_STATUS['NOT_STARTED'] => 'warning',
        self::TASK_STATUS['EXECUTION'] => 'warning',
        self::TASK_STATUS['COMPLETED'] => 'success',
        self::TASK_STATUS['FAILED'] => 'danger'
    );

    private $id;
    /**
     * @var int $category 类型
     */
    private $category;
    /**
     * @var string $exportFileName 导出文件名
     */
    private $exportFileName;
    /**
     * @var int $total 实际导出数量
     */
    private $total;
    /**
     * @var int $updatedNum 任务在执行期间已同步数据量
     */
    private $updatedNum;
    /**
     * @var array $filter 检索条件
     */
    private $filter;
    /**
     * @var string $sort 排序条件
     */
    private $sort;
    /**
     * @var int $offset 起始数量
     */
    private $offset;
    /**
     * @var int $size 期望导出数量
     */
    private $size;
    /**
     * @var int $code 执行失败状态码
     */
    private $code;
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
        $this->category = 0;
        $this->exportFileName = '';
        $this->total = 0;
        $this->updatedNum = 0;
        $this->filter = [];
        $this->sort = '';
        $this->size = 0;
        $this->offset = 0;
        $this->code = 0;
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->organization = new Organization();
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new ExportDataTaskRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->category);
        unset($this->exportFileName);
        unset($this->total);
        unset($this->size);
        unset($this->offset);
        unset($this->filter);
        unset($this->sort);
        unset($this->updatedNum);
        unset($this->code);
        unset($this->organization);
        unset($this->staff);
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
    
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setFilter(array $filter): void
    {
        $this->filter = $filter;
    }

    public function getFilter(): array
    {
        return $this->filter;
    }

    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }
    
    public function setSort(string $sort): void
    {
        $this->sort = $sort;
    }

    public function getSort(): string
    {
        return $this->sort;
    }

    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    protected function getRepository() : ExportDataTaskRepository
    {
        return $this->repository;
    }
}
