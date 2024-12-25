<?php
namespace Sdk\CreditModule\Financing\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\CreditModule\Financing\Repository\FinancingRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

class Financing implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;
    
    private $id;
    /**
     * @var string $subjectName 企业名称
     */
    private $subjectName;
    /**
     * @var string $unifiedIdentifier 统一社会信用代码
     */
    private $unifiedIdentifier;
    /**
     * @var int $financedAt 融资时间
     */
    private $financedAt;
    /**
     * @var string $stage 融资阶段
     */
    private $stage;
    /**
     * @var string $amount 融资金额
     */
    private $amount;
    /**
     * @var Organization $organization 发布委办局
     */
    private $organization;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->subjectName = '';
        $this->unifiedIdentifier = '';
        $this->financedAt = 0;
        $this->stage = '';
        $this->amount = '';
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new FinancingRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->subjectName);
        unset($this->unifiedIdentifier);
        unset($this->financedAt);
        unset($this->stage);
        unset($this->amount);
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

    public function setFinancedAt(int $financedAt): void
    {
        $this->financedAt = $financedAt;
    }

    public function getFinancedAt(): int
    {
        return $this->financedAt;
    }

    public function setSubjectName(string $subjectName): void
    {
        $this->subjectName = $subjectName;
    }

    public function getSubjectName(): string
    {
        return $this->subjectName;
    }

    public function setUnifiedIdentifier(string $unifiedIdentifier): void
    {
        $this->unifiedIdentifier = $unifiedIdentifier;
    }

    public function getUnifiedIdentifier(): string
    {
        return $this->unifiedIdentifier;
    }

    public function setStage(string $stage): void
    {
        $this->stage = $stage;
    }

    public function getStage(): string
    {
        return $this->stage;
    }

    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }
    
    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    protected function getRepository() : FinancingRepository
    {
        return $this->repository;
    }
}
