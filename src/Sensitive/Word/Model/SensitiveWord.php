<?php
namespace Sdk\Sensitive\Word\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Sensitive\Word\Repository\SensitiveWordRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

class SensitiveWord implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;
    
    private $id;
    /**
     * @var string $name 词名
     */
    private $name;
    /**
     * @var string $source 来源
     */
    private $source;
    /**
     * @var string $remark 备注
     */
    private $remark;
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
        $this->name = '';
        $this->source = '';
        $this->remark = '';
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new SensitiveWordRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->source);
        unset($this->remark);
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

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function setRemark(string $remark): void
    {
        $this->remark = $remark;
    }

    public function getRemark(): string
    {
        return $this->remark;
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

    protected function getRepository() : SensitiveWordRepository
    {
        return $this->repository;
    }

    public function batchProcess() : bool
    {
        return $this->getRepository()->batchProcess($this);
    }
}
