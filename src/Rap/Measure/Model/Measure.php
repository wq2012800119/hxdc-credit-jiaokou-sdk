<?php
namespace Sdk\Rap\Measure\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Rap\Measure\Repository\MeasureRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

use Sdk\Rap\Memorandum\Model\Memorandum;

class Measure implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    /**
     * 奖惩类型
     * PUNISHMENT 惩戒
     * INCENTIVE 激励
     */
    const REWARD_TYPE = array(
        'PUNISHMENT' => 1,
        'INCENTIVE' => 2
    );

    const REWARD_TYPE_CN = array(
        self::REWARD_TYPE['PUNISHMENT'] => '惩戒',
        self::REWARD_TYPE['INCENTIVE'] => '激励'
    );
    
    private $id;
    /**
     * @var string $name 名称
     */
    private $name;
    /**
     * @var string $description 描述
     */
    private $description;
    /**
     * @var int $rewardType 奖惩类型
     */
    private $rewardType;
    /**
     * @var array $implementationUnits 实施部门
     */
    private $implementationUnits;
    /**
     * @var Organization $organization 发布委办局
     */
    private $organization;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    /**
     * @var Memorandum $memorandum 关联备忘录
     */
    private $memorandum;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->name = '';
        $this->description = '';
        $this->rewardType = 0;
        $this->implementationUnits = array();
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->memorandum = new Memorandum();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new MeasureRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->description);
        unset($this->rewardType);
        unset($this->implementationUnits);
        unset($this->organization);
        unset($this->staff);
        unset($this->memorandum);
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

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setRewardType(int $rewardType): void
    {
        $this->rewardType = $rewardType;
    }

    public function getRewardType(): int
    {
        return $this->rewardType;
    }
    
    public function addImplementationUnit(Organization $implementationUnit): void
    {
        $this->implementationUnits[] = $implementationUnit;
    }

    public function clearImplementationUnits(): void
    {
        $this->implementationUnits = [];
    }

    public function setImplementationUnits(array $implementationUnits): void
    {
        $this->implementationUnits = $implementationUnits;
    }

    public function getImplementationUnits(): array
    {
        return $this->implementationUnits;
    }

    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    public function setMemorandum(Memorandum $memorandum): void
    {
        $this->memorandum = $memorandum;
    }

    public function getMemorandum(): Memorandum
    {
        return $this->memorandum;
    }
    
    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    protected function getRepository() : MeasureRepository
    {
        return $this->repository;
    }
}
