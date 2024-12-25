<?php
namespace Sdk\Sensitive\Task\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

class SensitiveTask implements IObject
{
    use Object;
    
    /**
     * 任务执行状态
     * NOT_STARTED 未开始
     * EXECUTION 正在执行
     * COMPLETED 执行完成
     * FAILED 执行失败
     */
    const STATUS = array(
        'NOT_STARTED' => 0,
        'EXECUTION' => 1,
        'COMPLETED' => 2,
        'FAILED' => -2
    );

    const STATUS_CN = array(
        self::STATUS['NOT_STARTED'] => '未开始',
        self::STATUS['EXECUTION'] => '正在执行',
        self::STATUS['COMPLETED'] => '执行完成',
        self::STATUS['FAILED'] => '执行失败'
    );
 
    const STATUS_TYPE = array(
        self::STATUS['NOT_STARTED'] => 'warning',
        self::STATUS['EXECUTION'] => 'warning',
        self::STATUS['COMPLETED'] => 'success',
        self::STATUS['FAILED'] => 'danger'
    );

    private $id;
    /**
     * @var int $updatedNum 更新数量
     */
    private $updatedNum;
    /**
     * @var Organization $organization 发布委办局
     */
    private $organization;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->updatedNum = 0;
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = self::STATUS['NOT_STARTED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->updatedNum);
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

    public function setUpdatedNum(int $updatedNum): void
    {
        $this->updatedNum = $updatedNum;
    }

    public function getUpdatedNum(): int
    {
        return $this->updatedNum;
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

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}
