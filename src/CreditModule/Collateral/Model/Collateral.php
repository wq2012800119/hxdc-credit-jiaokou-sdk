<?php
namespace Sdk\CreditModule\Collateral\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\CreditModule\Collateral\Repository\CollateralRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

class Collateral implements IObject, IOperateAble
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
     * @var string $registrationNumber 登记编号
     */
    private $registrationNumber;
    /**
     * @var int $registrationDate 登记日期
     */
    private $registrationDate;
    /**
     * @var string $registrationAgency 登记机关
     */
    private $registrationAgency;
    /**
     * @var string $securedBondAmount 被担保债券数额
     */
    private $securedBondAmount;
    /**
     * @var string $mortgageStatus 抵押状态
     */
    private $mortgageStatus;
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
        $this->registrationNumber = '';
        $this->registrationDate = 0;
        $this->registrationAgency = '';
        $this->securedBondAmount = '';
        $this->mortgageStatus = '';
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new CollateralRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->subjectName);
        unset($this->unifiedIdentifier);
        unset($this->registrationNumber);
        unset($this->registrationDate);
        unset($this->registrationAgency);
        unset($this->securedBondAmount);
        unset($this->mortgageStatus);
        unset($this->organization);
        unset($this->staff);
        unset($this->status);
        unset($this->updateTime);
        unset($this->createTime);
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

    public function setRegistrationNumber(string $registrationNumber): void
    {
        $this->registrationNumber = $registrationNumber;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function setRegistrationDate(int $registrationDate): void
    {
        $this->registrationDate = $registrationDate;
    }

    public function getRegistrationDate(): int
    {
        return $this->registrationDate;
    }

    public function setRegistrationAgency(string $registrationAgency): void
    {
        $this->registrationAgency = $registrationAgency;
    }

    public function getRegistrationAgency(): string
    {
        return $this->registrationAgency;
    }

    public function setSecuredBondAmount(string $securedBondAmount): void
    {
        $this->securedBondAmount = $securedBondAmount;
    }

    public function getSecuredBondAmount(): string
    {
        return $this->securedBondAmount;
    }

    public function setMortgageStatus(string $mortgageStatus): void
    {
        $this->mortgageStatus = $mortgageStatus;
    }

    public function getMortgageStatus(): string
    {
        return $this->mortgageStatus;
    }

    protected function getRepository() : CollateralRepository
    {
        return $this->repository;
    }
}
