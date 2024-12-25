<?php
namespace Sdk\Contract\BreachInfo\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Contract\BreachInfo\Repository\BreachInfoRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\Organization\Organization\Model\Organization;

use Sdk\Contract\Performance\Model\Performance;

class BreachInfo implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    private $id;
    /**
     * @var string $wyf 违约方
     */
    private $wyf;
    /**
     * @var string $wysy 违约事由
     */
    private $wysy;
    /**
     * @var string $wyyj 违约依据
     */
    private $wyyj;
    /**
     * @var string $wyzt 违约状态
     */
    private $wyzt;
    /**
     * @var string $sjlydw 数据来源单位
     */
    private $sjlydw;
    /**
     * @var Performance $performance 合同履约信息
     */
    private $performance;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    /**
     * @var Organization $organization 发布委办局
     */
    private $organization;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->wyf = '';
        $this->wysy = '';
        $this->wyyj = '';
        $this->wyzt = '';
        $this->sjlydw = '';
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->organization = new Organization();
        $this->performance = new Performance();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new BreachInfoRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->wyf);
        unset($this->wysy);
        unset($this->wyyj);
        unset($this->wyzt);
        unset($this->sjlydw);
        unset($this->staff);
        unset($this->organization);
        unset($this->performance);
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

    public function setWyf(string $wyf): void
    {
        $this->wyf = $wyf;
    }

    public function getWyf(): string
    {
        return $this->wyf;
    }

    public function setWysy(string $wysy): void
    {
        $this->wysy = $wysy;
    }

    public function getWysy(): string
    {
        return $this->wysy;
    }

    public function setWyyj(string $wyyj): void
    {
        $this->wyyj = $wyyj;
    }

    public function getWyyj(): string
    {
        return $this->wyyj;
    }

    public function setSjlydw(string $sjlydw): void
    {
        $this->sjlydw = $sjlydw;
    }

    public function getSjlydw(): string
    {
        return $this->sjlydw;
    }

    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }
    
    public function setWyzt(string $wyzt): void
    {
        $this->wyzt = $wyzt;
    }

    public function getWyzt(): string
    {
        return $this->wyzt;
    }

    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    public function setPerformance(Performance $performance): void
    {
        $this->performance = $performance;
    }

    public function getPerformance(): Performance
    {
        return $this->performance;
    }

    protected function getRepository() : BreachInfoRepository
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
}
