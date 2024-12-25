<?php
namespace Sdk\Application\Commitment\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\ExamineAbleTrait;
use Sdk\Common\Model\Interfaces\IExamineAble;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Application\Commitment\Repository\PromiseRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class Promise implements IObject, IOperateAble, IExamineAble
{
    use Object, OperateAbleTrait, ExamineAbleTrait;

    /**
     * 承诺履行状态
     * QBLX 全部履行
     * BFLX 部分履行
     * QBWLX 全部未履行
     */
    const FULFILLMENT_STATUS = array(
        'QBLX' => 1,
        'BFLX' => 2,
        'QBWLX' => 3
    );

    const FULFILLMENT_STATUS_CN = array(
        self::FULFILLMENT_STATUS['QBLX'] => '全部履行',
        self::FULFILLMENT_STATUS['BFLX'] => '部分履行',
        self::FULFILLMENT_STATUS['QBWLX'] => '全部未履行'
    );
       
    private $id;
    /**
     * @var int $fulfillmentStatus 承诺履行状态
     */
    private $fulfillmentStatus;
    /**
     * @var string $unperformedCommitmentContent 未履行的承诺内容
     */
    private $unperformedCommitmentContent;
    /**
     * @var string $liabilityBreachCommitmentContent 违诺责任追究内容
     */
    private $liabilityBreachCommitmentContent;
    /**
     * @var int $fulfillmentStatusDate 承诺履行状态认定日期
     */
    private $fulfillmentStatusDate;
    /**
     * @var string $acceptanceConfirmUnit 承诺履行状态认定单位
     */
    private $acceptanceConfirmUnit;
    /**
     * @var string $acceptanceConfirmUnitIdentify 承诺履行状态认定单位代码
     */
    private $acceptanceConfirmUnitIdentify;
    /**
     * @var Organization $organization 发布委办局
     */
    private $organization;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    /**
     * @var int $commitmentId 信用承诺id
     */
    private $commitmentId;
    /**
     * @var int $snapshotId 快照id
     */
    private $snapshotId;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->fulfillmentStatus = 0;
        $this->unperformedCommitmentContent = '';
        $this->liabilityBreachCommitmentContent = '';
        $this->fulfillmentStatusDate = 0;
        $this->acceptanceConfirmUnit = '';
        $this->acceptanceConfirmUnitIdentify = '';
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->organization = new Organization();
        $this->snapshotId = 0;
        $this->commitmentId = 0;
        $this->status = self::STATUS['ENABLED'];
        $this->examineStatus = self::EXAMINE_STATUS['PENDING'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new PromiseRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->fulfillmentStatus);
        unset($this->unperformedCommitmentContent);
        unset($this->liabilityBreachCommitmentContent);
        unset($this->fulfillmentStatusDate);
        unset($this->acceptanceConfirmUnit);
        unset($this->acceptanceConfirmUnitIdentify);
        unset($this->staff);
        unset($this->organization);
        unset($this->snapshotId);
        unset($this->commitmentId);
        unset($this->status);
        unset($this->examineStatus);
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

    public function setFulfillmentStatus(int $fulfillmentStatus): void
    {
        $this->fulfillmentStatus = $fulfillmentStatus;
    }

    public function getFulfillmentStatus(): int
    {
        return $this->fulfillmentStatus;
    }

    public function setUnperformedCommitmentContent(string $unperformedCommitmentContent): void
    {
        $this->unperformedCommitmentContent = $unperformedCommitmentContent;
    }

    public function getUnperformedCommitmentContent(): string
    {
        return $this->unperformedCommitmentContent;
    }

    public function setLiabilityBreachCommitmentContent(string $liabilityBreachCommitmentContent): void
    {
        $this->liabilityBreachCommitmentContent = $liabilityBreachCommitmentContent;
    }

    public function getLiabilityBreachCommitmentContent(): string
    {
        return $this->liabilityBreachCommitmentContent;
    }

    public function setFulfillmentStatusDate(int $fulfillmentStatusDate): void
    {
        $this->fulfillmentStatusDate = $fulfillmentStatusDate;
    }

    public function getFulfillmentStatusDate(): int
    {
        return $this->fulfillmentStatusDate;
    }
    
    public function setAcceptanceConfirmUnit(string $acceptanceConfirmUnit): void
    {
        $this->acceptanceConfirmUnit = $acceptanceConfirmUnit;
    }

    public function getAcceptanceConfirmUnit(): string
    {
        return $this->acceptanceConfirmUnit;
    }
    
    public function setAcceptanceConfirmUnitIdentify(string $acceptanceConfirmUnitIdentify): void
    {
        $this->acceptanceConfirmUnitIdentify = $acceptanceConfirmUnitIdentify;
    }

    public function getAcceptanceConfirmUnitIdentify(): string
    {
        return $this->acceptanceConfirmUnitIdentify;
    }
    
    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    public function setSnapshotId(int $snapshotId): void
    {
        $this->snapshotId = $snapshotId;
    }

    public function getSnapshotId(): int
    {
        return $this->snapshotId;
    }

    public function setCommitmentId(int $commitmentId): void
    {
        $this->commitmentId = $commitmentId;
    }

    public function getCommitmentId(): int
    {
        return $this->commitmentId;
    }
    
    protected function getRepository() : PromiseRepository
    {
        return $this->repository;
    }
}
