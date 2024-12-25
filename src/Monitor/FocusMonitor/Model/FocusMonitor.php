<?php
namespace Sdk\Monitor\FocusMonitor\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Monitor\FocusMonitor\Repository\FocusMonitorRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class FocusMonitor implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    /**
     * 主体类别
     * FR 法人
     * ZRR 自然人
     */
    const SUBJECT_CATEGORY = array(
        'FR' => 5,
        'ZRR' => 2
    );

    const SUBJECT_CATEGORY_CN = array(
        self::SUBJECT_CATEGORY['FR'] => '法人',
        self::SUBJECT_CATEGORY['ZRR'] => '自然人'
    );
    
    private $id;
    /**
     * @var string $name 主体名称
     */
    private $name;
    /**
     * @var string $identify 主体标识
     */
    private $identify;
    /**
     * @var int $subjectCategory 主体类别
     */
    private $subjectCategory;
    /**
     * @var int $penaltyThreshold 行政处罚阈值
     */
    private $penaltyThreshold;
    /**
     * @var int $dishonestyThreshold 严重失信阈值
     */
    private $dishonestyThreshold;
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
        $this->identify = '';
        $this->subjectCategory = 0;
        $this->penaltyThreshold = 0;
        $this->dishonestyThreshold = 0;
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->organization = new Organization();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new FocusMonitorRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->identify);
        unset($this->subjectCategory);
        unset($this->penaltyThreshold);
        unset($this->dishonestyThreshold);
        unset($this->staff);
        unset($this->organization);
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

    public function setIdentify(string $identify): void
    {
        $this->identify = $identify;
    }

    public function getIdentify(): string
    {
        return $this->identify;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setSubjectCategory(int $subjectCategory): void
    {
        $this->subjectCategory = $subjectCategory;
    }

    public function getSubjectCategory(): int
    {
        return $this->subjectCategory;
    }

    public function setPenaltyThreshold(int $penaltyThreshold): void
    {
        $this->penaltyThreshold = $penaltyThreshold;
    }

    public function getPenaltyThreshold(): int
    {
        return $this->penaltyThreshold;
    }

    public function setDishonestyThreshold(int $dishonestyThreshold): void
    {
        $this->dishonestyThreshold = $dishonestyThreshold;
    }

    public function getDishonestyThreshold(): int
    {
        return $this->dishonestyThreshold;
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
    
    protected function getRepository() : FocusMonitorRepository
    {
        return $this->repository;
    }
}
