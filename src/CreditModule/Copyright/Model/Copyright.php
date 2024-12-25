<?php
namespace Sdk\CreditModule\Copyright\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\CreditModule\Copyright\Repository\CopyrightRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

class Copyright implements IObject, IOperateAble
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
     * @var string $title 著作名称
     */
    private $title;
    /**
     * @var string $registrationNumber 登记号
     */
    private $registrationNumber;
    /**
     * @var string $conditions 状况
     */
    private $conditions;
    /**
     * @var int $registrationDate 登记日期
     */
    private $registrationDate;
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
        $this->title = '';
        $this->registrationNumber = '';
        $this->conditions = '';
        $this->registrationDate = 0;
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new CopyrightRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->subjectName);
        unset($this->unifiedIdentifier);
        unset($this->title);
        unset($this->registrationNumber);
        unset($this->conditions);
        unset($this->registrationDate);
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

    public function setUnifiedIdentifier(string $unifiedIdentifier): void
    {
        $this->unifiedIdentifier = $unifiedIdentifier;
    }

    public function getUnifiedIdentifier(): string
    {
        return $this->unifiedIdentifier;
    }

    public function setSubjectName(string $subjectName): void
    {
        $this->subjectName = $subjectName;
    }

    public function getSubjectName(): string
    {
        return $this->subjectName;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setConditions(string $conditions): void
    {
        $this->conditions = $conditions;
    }

    public function getConditions(): string
    {
        return $this->conditions;
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

    protected function getRepository() : CopyrightRepository
    {
        return $this->repository;
    }
}
