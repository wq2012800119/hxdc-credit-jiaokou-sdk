<?php
namespace Sdk\Application\Commitment\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\ExamineAbleTrait;
use Sdk\Common\Model\Interfaces\IExamineAble;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Application\Commitment\Repository\CommitmentRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class Commitment implements IObject, IOperateAble, IExamineAble
{
    use Object, OperateAbleTrait, ExamineAbleTrait;

    /**
     * 承诺人类别
     * FRJFFRZZ 法人及非法人组织
     * ZRR 自然人
     * GTGSH 个体工商户
     */
    const SUBJECT_CATEGORY = array(
        'FRJFFRZZ' => 1,
        'ZRR' => 2,
        'GTGSH' => 4
    );

    const SUBJECT_CATEGORY_CN = array(
        self::SUBJECT_CATEGORY['FRJFFRZZ'] => '法人及非法人组织',
        self::SUBJECT_CATEGORY['ZRR'] => '自然人',
        self::SUBJECT_CATEGORY['GTGSH'] => '个体工商户'
    );
    
    /**
     * 承诺类型
     * QT 其他
     * SPTDX 审批替代型
     * RQSLX 容缺受理型
     * ZMSXX 证明事项型
     * XYXFX 信用修复型
     * HYZLX 行业自律型
     * ZDX 主动型
     */
    const COMMITMENT_TYPE_ID = array(
        'QT' => 0,
        'SPTDX' => 1,
        'RQSLX' => 2,
        'ZMSXX' => 3,
        'XYXFX' => 4,
        'HYZLX' => 5,
        'ZDX' => 6,
    );

    const COMMITMENT_TYPE_CN = array(
        self::COMMITMENT_TYPE_ID['QT'] => '其他',
        self::COMMITMENT_TYPE_ID['SPTDX'] => '审批替代型',
        self::COMMITMENT_TYPE_ID['RQSLX'] => '容缺受理型',
        self::COMMITMENT_TYPE_ID['ZMSXX'] => '证明事项型',
        self::COMMITMENT_TYPE_ID['XYXFX'] => '信用修复型',
        self::COMMITMENT_TYPE_ID['HYZLX'] => '行业自律型',
        self::COMMITMENT_TYPE_ID['ZDX'] => '主动型'
    );
    
    /**
     * 公开类型
     * KXSHGK 可向社会公开
     * TDFWNGK 特定范围内公开
     * BKGK 不可公开
     */
    const PUBLICATION_TYPE = array(
        'KXSHGK' => 1,
        'TDFWNGK' => 2,
        'BKGK' => 3
    );

    const PUBLICATION_TYPE_CN = array(
        self::PUBLICATION_TYPE['KXSHGK'] => '可向社会公开',
        self::PUBLICATION_TYPE['TDFWNGK'] => '特定范围内公开',
        self::PUBLICATION_TYPE['BKGK'] => '不可公开'
    );

    /**
     * 承诺监管状态
     * DOING 监管中
     * DONE 监管完成
     */
    const SUPERVISE_STATUS = array(
        'DOING' => 0,
        'DONE' => 2
    );

    const SUPERVISE_STATUS_CN = array(
        self::SUPERVISE_STATUS['DOING'] => '监管中',
        self::SUPERVISE_STATUS['DONE'] => '监管完成'
    );

    /**
     * 承诺过期状态
     * EXPIRED 已过期
     * NOT_EXPIRED 未过期
     */
    const PAST_DUE_STATUS = array(
        'EXPIRED' => -2,
        'NOT_EXPIRED' => 0
    );

    const PAST_DUE_STATUS_CN = array(
        self::PAST_DUE_STATUS['EXPIRED'] => '已过期',
        self::PAST_DUE_STATUS['NOT_EXPIRED'] => '未过期'
    );

    private $id;
    /**
     * @var string $code 承诺编码
     */
    private $code;
    /**
     * @var string $subjectName 承诺人名称
     */
    private $subjectName;
    /**
     * @var int $subjectCategory 承诺人类别
     */
    private $subjectCategory;
    /**
     * @var string $identify 承诺人代码
     */
    private $identify;
    /**
     * @var int $commitmentTypeId 承诺类型
     */
    private $commitmentTypeId;
    /**
     * @var string $commitmentTypeOther 承诺类型其他
     */
    private $commitmentTypeOther;
    /**
     * @var string $reason 承诺事由
     */
    private $reason;
    /**
     * @var string $content 承诺内容
     */
    private $content;
    /**
     * @var string $liabilityBreachCommitment 违诺责任
     */
    private $liabilityBreachCommitment;
    /**
     * @var int $commitmentDate 承诺作出日期
     */
    private $commitmentDate;
    /**
     * @var int $commitmentValidity 承诺有效期
     */
    private $commitmentValidity;
    /**
     * @var string $acceptanceUnit 承诺受理单位
     */
    private $acceptanceUnit;
    /**
     * @var string $acceptanceUnitIdentify 承诺受理单位代码
     */
    private $acceptanceUnitIdentify;
    /**
     * @var int $publicationType 公开类型
     */
    private $publicationType;
    /**
     * @var string $remarks 备注
     */
    private $remarks;
    /**
     * @var int $superviseStatus 承诺监管状态
     */
    private $superviseStatus;
    /**
     * @var int $pastDueStatus 承诺过期状态
     */
    private $pastDueStatus;
    /**
     * @var Organization $organization 发布委办局
     */
    private $organization;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    /**
     * @var int $snapshotId 快照id
     */
    private $snapshotId;
    /**
     * @var Promise $promise 履约践诺信息
     */
    private $promise;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->code = '';
        $this->subjectName = '';
        $this->subjectCategory = 0;
        $this->identify = '';
        $this->commitmentTypeId = 0;
        $this->commitmentTypeOther = '';
        $this->reason = '';
        $this->content = '';
        $this->liabilityBreachCommitment = '';
        $this->commitmentDate = 0;
        $this->commitmentValidity = 0;
        $this->acceptanceUnit = '';
        $this->acceptanceUnitIdentify = '';
        $this->publicationType = 0;
        $this->remarks = '';
        $this->superviseStatus = 0;
        $this->pastDueStatus = 0;
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->organization = new Organization();
        $this->promise = new Promise();
        $this->snapshotId = 0;
        $this->status = self::STATUS['ENABLED'];
        $this->examineStatus = self::EXAMINE_STATUS['PENDING'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new CommitmentRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->code);
        unset($this->subjectName);
        unset($this->subjectCategory);
        unset($this->identify);
        unset($this->commitmentTypeId);
        unset($this->commitmentTypeOther);
        unset($this->reason);
        unset($this->content);
        unset($this->liabilityBreachCommitment);
        unset($this->commitmentDate);
        unset($this->commitmentValidity);
        unset($this->acceptanceUnit);
        unset($this->acceptanceUnitIdentify);
        unset($this->publicationType);
        unset($this->remarks);
        unset($this->superviseStatus);
        unset($this->pastDueStatus);
        unset($this->staff);
        unset($this->organization);
        unset($this->snapshotId);
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

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setSubjectName(string $subjectName): void
    {
        $this->subjectName = $subjectName;
    }

    public function getSubjectName(): string
    {
        return $this->subjectName;
    }

    public function setSubjectCategory(int $subjectCategory): void
    {
        $this->subjectCategory = $subjectCategory;
    }

    public function getSubjectCategory(): int
    {
        return $this->subjectCategory;
    }

    public function setIdentify(string $identify): void
    {
        $this->identify = $identify;
    }

    public function getIdentify(): string
    {
        return $this->identify;
    }

    public function setCommitmentTypeId(int $commitmentTypeId): void
    {
        $this->commitmentTypeId = $commitmentTypeId;
    }

    public function getCommitmentTypeId(): int
    {
        return $this->commitmentTypeId;
    }
    
    public function setCommitmentTypeOther(string $commitmentTypeOther): void
    {
        $this->commitmentTypeOther = $commitmentTypeOther;
    }

    public function getCommitmentTypeOther(): string
    {
        return $this->commitmentTypeOther;
    }
    
    public function setReason(string $reason): void
    {
        $this->reason = $reason;
    }

    public function getReason(): string
    {
        return $this->reason;
    }
    
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }
    
    public function setLiabilityBreachCommitment(string $liabilityBreachCommitment): void
    {
        $this->liabilityBreachCommitment = $liabilityBreachCommitment;
    }

    public function getLiabilityBreachCommitment(): string
    {
        return $this->liabilityBreachCommitment;
    }

    public function setCommitmentDate(int $commitmentDate): void
    {
        $this->commitmentDate = $commitmentDate;
    }

    public function getCommitmentDate(): int
    {
        return $this->commitmentDate;
    }

    public function setCommitmentValidity(int $commitmentValidity): void
    {
        $this->commitmentValidity = $commitmentValidity;
    }

    public function getCommitmentValidity(): int
    {
        return $this->commitmentValidity;
    }

    public function setAcceptanceUnit(string $acceptanceUnit): void
    {
        $this->acceptanceUnit = $acceptanceUnit;
    }

    public function getAcceptanceUnit(): string
    {
        return $this->acceptanceUnit;
    }

    public function setAcceptanceUnitIdentify(string $acceptanceUnitIdentify): void
    {
        $this->acceptanceUnitIdentify = $acceptanceUnitIdentify;
    }

    public function getAcceptanceUnitIdentify(): string
    {
        return $this->acceptanceUnitIdentify;
    }

    public function setPublicationType(int $publicationType): void
    {
        $this->publicationType = $publicationType;
    }

    public function getPublicationType(): int
    {
        return $this->publicationType;
    }

    public function setRemarks(string $remarks): void
    {
        $this->remarks = $remarks;
    }

    public function getRemarks(): string
    {
        return $this->remarks;
    }

    public function setSuperviseStatus(int $superviseStatus): void
    {
        $this->superviseStatus = $superviseStatus;
    }

    public function getSuperviseStatus(): int
    {
        return $this->superviseStatus;
    }

    public function setPastDueStatus(int $pastDueStatus): void
    {
        $this->pastDueStatus = $pastDueStatus;
    }

    public function getPastDueStatus(): int
    {
        return $this->pastDueStatus;
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

    public function setPromise(Promise $promise): void
    {
        $this->promise = $promise;
    }

    public function getPromise(): Promise
    {
        return $this->promise;
    }
    
    public function setSnapshotId(int $snapshotId): void
    {
        $this->snapshotId = $snapshotId;
    }

    public function getSnapshotId(): int
    {
        return $this->snapshotId;
    }
    
    protected function getRepository()
    {
        return $this->repository;
    }

    public function superviseDoing() : bool
    {
        return $this->getRepository()->superviseDoing($this);
    }

    public function superviseDone() : bool
    {
        return $this->getRepository()->superviseDone($this);
    }
}
