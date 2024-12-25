<?php
namespace Sdk\CreditModule\Taxation\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\CreditModule\Taxation\Repository\TaxationRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

class Taxation implements IObject, IOperateAble
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
     * @var string $identificationNumber 纳税人识别号
     */
    private $identificationNumber;
    /**
     * @var string $outstandingTaxBalance 欠税余额
     */
    private $outstandingTaxBalance;
    /**
     * @var string $totalTaxAmount 纳税总额
     */
    private $totalTaxAmount;
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
        $this->identificationNumber = '';
        $this->outstandingTaxBalance = '';
        $this->totalTaxAmount = '';
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new TaxationRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->subjectName);
        unset($this->unifiedIdentifier);
        unset($this->identificationNumber);
        unset($this->outstandingTaxBalance);
        unset($this->totalTaxAmount);
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

    public function setIdentificationNumber(string $identificationNumber): void
    {
        $this->identificationNumber = $identificationNumber;
    }

    public function getIdentificationNumber(): string
    {
        return $this->identificationNumber;
    }

    public function setOutstandingTaxBalance(string $outstandingTaxBalance): void
    {
        $this->outstandingTaxBalance = $outstandingTaxBalance;
    }

    public function getOutstandingTaxBalance(): string
    {
        return $this->outstandingTaxBalance;
    }

    public function setTotalTaxAmount(string $totalTaxAmount): void
    {
        $this->totalTaxAmount = $totalTaxAmount;
    }

    public function getTotalTaxAmount(): string
    {
        return $this->totalTaxAmount;
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

    protected function getRepository() : TaxationRepository
    {
        return $this->repository;
    }
}
