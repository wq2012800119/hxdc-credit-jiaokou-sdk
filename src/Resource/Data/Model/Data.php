<?php
namespace Sdk\Resource\Data\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\ExamineAbleTrait;
use Sdk\Common\Model\Interfaces\IExamineAble;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Resource\Data\Repository\DataRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\Resource\Directory\Model\DirectorySnapshot;

use Sdk\Organization\Organization\Model\Organization;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class Data implements IObject, IOperateAble, IExamineAble
{
    use Object, OperateAbleTrait, ExamineAbleTrait;

    const DATA_STATUS_CN = array(
        self::STATUS['ENABLED'] => '正常',
        self::STATUS['DISABLED'] => '屏蔽'
    );

    const DATA_NOT_EXPIRE_STATUS = 0;
    
    private $id;
    /**
     * @var string $subjectName 主体名称
     */
    private $subjectName;
    /**
     * @var string $identify 主体标识
     */
    private $identify;
    /**
     * @var int $subjectCategory 信用主体类别
     */
    private $subjectCategory;
    /**
     * @var int $infoCategory 信息类别
     */
    private $infoCategory;
    /**
     * @var int $publicationRange 公开范围
     */
    private $publicationRange;
    /**
     * @var int $expireDate 过期时间
     */
    private $expireDate;
    /**
     * @var int $exchangeSyncStatus 前置机同步状态
     */
    private $exchangeSyncStatus;
    /**
     * @var int $internalSyncStatus 内部同步状态
     */
    private $internalSyncStatus;
    /**
     * @var array $items 模板信息数据
     */
    private $items;
    /**
     * @var Organization $organization 发布委办局
     */
    private $organization;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    /**
     * @var Directory $directory 目录
     */
    private $directory;
    /**
     * @var DirectorySnapshot $directorySnapshot 目录快照
     */
    private $directorySnapshot;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->subjectName = '';
        $this->identify = '';
        $this->subjectCategory = 0;
        $this->infoCategory = 0;
        $this->publicationRange = 0;
        $this->expireDate = 0;
        $this->exchangeSyncStatus = 0;
        $this->internalSyncStatus = 0;
        $this->items = array();
        $this->organization = new Organization();
        $this->directory = new Directory();
        $this->directorySnapshot = new DirectorySnapshot();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = self::STATUS['ENABLED'];
        $this->examineStatus = self::EXAMINE_STATUS['PENDING'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new DataRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->subjectName);
        unset($this->identify);
        unset($this->subjectCategory);
        unset($this->infoCategory);
        unset($this->publicationRange);
        unset($this->expireDate);
        unset($this->exchangeSyncStatus);
        unset($this->internalSyncStatus);
        unset($this->items);
        unset($this->organization);
        unset($this->directory);
        unset($this->directorySnapshot);
        unset($this->staff);
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

    public function setSubjectName(string $subjectName): void
    {
        $this->subjectName = $subjectName;
    }

    public function getSubjectName(): string
    {
        return $this->subjectName;
    }

    public function setIdentify(string $identify): void
    {
        $this->identify = $identify;
    }

    public function getIdentify(): string
    {
        return $this->identify;
    }

    public function setSubjectCategory(int $subjectCategory): void
    {
        $this->subjectCategory = $subjectCategory;
    }

    public function getSubjectCategory(): int
    {
        return $this->subjectCategory;
    }

    public function setInfoCategory(int $infoCategory): void
    {
        $this->infoCategory = $infoCategory;
    }

    public function getInfoCategory(): int
    {
        return $this->infoCategory;
    }

    public function setPublicationRange(int $publicationRange): void
    {
        $this->publicationRange = $publicationRange;
    }

    public function getPublicationRange(): int
    {
        return $this->publicationRange;
    }

    public function setExpireDate(int $expireDate): void
    {
        $this->expireDate = $expireDate;
    }

    public function getExpireDate(): int
    {
        return $this->expireDate;
    }

    public function setExchangeSyncStatus(int $exchangeSyncStatus): void
    {
        $this->exchangeSyncStatus = $exchangeSyncStatus;
    }

    public function getExchangeSyncStatus(): int
    {
        return $this->exchangeSyncStatus;
    }

    public function setInternalSyncStatus(int $internalSyncStatus): void
    {
        $this->internalSyncStatus = $internalSyncStatus;
    }

    public function getInternalSyncStatus(): int
    {
        return $this->internalSyncStatus;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    public function setDirectory(Directory $directory): void
    {
        $this->directory = $directory;
    }

    public function getDirectory(): Directory
    {
        return $this->directory;
    }

    public function setDirectorySnapshot(DirectorySnapshot $directorySnapshot): void
    {
        $this->directorySnapshot = $directorySnapshot;
    }

    public function getDirectorySnapshot(): DirectorySnapshot
    {
        return $this->directorySnapshot;
    }

    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    protected function getRepository()
    {
        return $this->repository;
    }

    public function update() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }
}
