<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\WebsiteConfig\HomePageConfig\Repository\HomePageConfigRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

class HomePageConfig implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    const HOME_PAGE_CONFIG_STATUS_CN = array(
        self::STATUS['ENABLED'] => '发布',
        self::STATUS['DISABLED'] => '未发布'
    );

    private $id;
    /**
     * @var string $versionDescription 版本描述
     */
    private $versionDescription;
    /**
     * @var array $diyContent 自定义内容
     */
    private $diyContent;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->versionDescription = '';
        $this->diyContent = array();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new HomePageConfigRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->versionDescription);
        unset($this->diyContent);
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

    public function setVersionDescription(string $versionDescription): void
    {
        $this->versionDescription = $versionDescription;
    }

    public function getVersionDescription(): string
    {
        return $this->versionDescription;
    }

    public function setDiyContent(array $diyContent): void
    {
        $this->diyContent = $diyContent;
    }

    public function getDiyContent(): array
    {
        return $this->diyContent;
    }

    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    protected function getRepository() : HomePageConfigRepository
    {
        return $this->repository;
    }

    public function enable() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }

    public function disable() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }

    public function update() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }

    public function publish() : bool
    {
        return $this->getRepository()->publish($this);
    }
}
