<?php
namespace Sdk\Contract\FulfillmentInfo\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Contract\FulfillmentInfo\Repository\FulfillmentInfoRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;
use Sdk\Organization\Organization\Model\Organization;

use Sdk\Contract\Performance\Model\Performance;

class FulfillmentInfo implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    private $id;
    /**
     * @var string $htzxjd 合同执行阶段
     */
    private $htzxjd;
    /**
     * @var string $htzjsfqezf 合同资金是否全额支付
     */
    private $htzjsfqezf;
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
        $this->htzxjd = '';
        $this->htzjsfqezf = '';
        $this->sjlydw = '';
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->organization = new Organization();
        $this->performance = new Performance();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new FulfillmentInfoRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->htzxjd);
        unset($this->htzjsfqezf);
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

    public function setHtzxjd(string $htzxjd): void
    {
        $this->htzxjd = $htzxjd;
    }

    public function getHtzxjd(): string
    {
        return $this->htzxjd;
    }

    public function setHtzjsfqezf(string $htzjsfqezf): void
    {
        $this->htzjsfqezf = $htzjsfqezf;
    }

    public function getHtzjsfqezf(): string
    {
        return $this->htzjsfqezf;
    }

    public function setSjlydw(string $sjlydw): void
    {
        $this->sjlydw = $sjlydw;
    }

    public function getSjlydw(): string
    {
        return $this->sjlydw;
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

    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }
    
    protected function getRepository() : FulfillmentInfoRepository
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
