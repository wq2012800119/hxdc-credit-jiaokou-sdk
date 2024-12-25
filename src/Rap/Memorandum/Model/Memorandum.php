<?php
namespace Sdk\Rap\Memorandum\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Rap\Memorandum\Repository\MemorandumRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class Memorandum implements IObject, IOperateAble
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
     * @var string $documentNo 文号
     */
    private $documentNo;
    /**
     * @var string $originatingUnit 发起单位
     */
    private $originatingUnit;
    /**
     * @var int $releaseDate 发布日期
     */
    private $releaseDate;
    /**
     * @var int $rewardType 奖惩类型
     */
    private $rewardType;
    /**
     * @var string $jointSigningDepartment 联合签署部门
     */
    private $jointSigningDepartment;
    /**
     * @var string $content 内容
     */
    private $content;
    /**
     * @var array $attachments 附件
     */
    private $attachments;
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
        $this->documentNo = '';
        $this->originatingUnit = '';
        $this->releaseDate = 0;
        $this->rewardType = 0;
        $this->jointSigningDepartment = '';
        $this->content = '';
        $this->attachments = array();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->organization = new Organization();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new MemorandumRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->documentNo);
        unset($this->originatingUnit);
        unset($this->releaseDate);
        unset($this->rewardType);
        unset($this->jointSigningDepartment);
        unset($this->content);
        unset($this->attachments);
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

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDocumentNo(string $documentNo): void
    {
        $this->documentNo = $documentNo;
    }

    public function getDocumentNo(): string
    {
        return $this->documentNo;
    }

    public function setOriginatingUnit(string $originatingUnit): void
    {
        $this->originatingUnit = $originatingUnit;
    }

    public function getOriginatingUnit(): string
    {
        return $this->originatingUnit;
    }

    public function setReleaseDate(int $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function getReleaseDate(): int
    {
        return $this->releaseDate;
    }

    public function setRewardType(int $rewardType): void
    {
        $this->rewardType = $rewardType;
    }

    public function getRewardType(): int
    {
        return $this->rewardType;
    }
    
    public function setJointSigningDepartment(string $jointSigningDepartment): void
    {
        $this->jointSigningDepartment = $jointSigningDepartment;
    }

    public function getJointSigningDepartment(): string
    {
        return $this->jointSigningDepartment;
    }
    
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }
    
    public function setAttachments(array $attachments): void
    {
        $this->attachments = $attachments;
    }

    public function getAttachments(): array
    {
        return $this->attachments;
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
    
    protected function getRepository() : MemorandumRepository
    {
        return $this->repository;
    }
}
