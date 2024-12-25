<?php
namespace Sdk\Rap\RapCase\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Rap\RapCase\Repository\RapCaseRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

use Sdk\Rap\Measure\Model\Measure;
use Sdk\Resource\Data\Model\Data;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class RapCase implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    /**
     * 主体类别
     * LEGAL_PERSON 法人
     * NATURAL_PERSON 自然人
     */
    const ZTLB = array(
        'LEGAL_PERSON' => 0,
        'NATURAL_PERSON' => 1
    );

    const ZTLB_CN = array(
        self::ZTLB['LEGAL_PERSON'] => '法人',
        self::ZTLB['NATURAL_PERSON'] => '自然人'
    );

    /**
     * 奖惩类型
     * PUNISHMENT 惩戒
     * INCENTIVE 激励
     */
    const JCLX = array(
        'PUNISHMENT' => 1,
        'INCENTIVE' => 2
    );

    const JCLX_CN = array(
        self::JCLX['PUNISHMENT'] => '惩戒',
        self::JCLX['INCENTIVE'] => '激励'
    );
    
    /**
     * 证件类型
     * SFZ 身份证
     * JRSFYXZJ 军人身份有效证件
     * AGJMLWNDTXZ 港澳居民来往内地通行证
     * TWJMLWDLTXZ 台湾居民来往大陆通行证
     * HZ 护照
     * QTFDRKDZJ 其他法定认可的证件
     */
    const ZJLX = array(
        'SFZ' => 10,
        'JRSFYXZJ' => 20,
        'AGJMLWNDTXZ' => 30,
        'TWJMLWDLTXZ' => 40,
        'HZ' => 50,
        'QTFDRKDZJ' => 90
    );

    const ZJLX_CN = array(
        self::ZJLX['SFZ'] => '身份证',
        self::ZJLX['JRSFYXZJ'] => '军人身份有效证件',
        self::ZJLX['AGJMLWNDTXZ'] => '港澳居民来往内地通行证',
        self::ZJLX['TWJMLWDLTXZ'] => '台湾居民来往大陆通行证',
        self::ZJLX['HZ'] => '护照',
        self::ZJLX['QTFDRKDZJ'] => '其他法定认可的证件'
    );

    private $id;
    /**
     * @var string $hhmdmc 红黑名单名称
     */
    private $hhmdmc;
    /**
     * @var string $ztmc 主体名称
     */
    private $ztmc;
    /**
     * @var int $ztlb 主体类别
     */
    private $ztlb;
    /**
     * @var string $identify 主体标识
     */
    private $identify;
    /**
     * @var int $zjlx 证件类型
     */
    private $zjlx;
    /**
     * @var int $jclx 奖惩类型
     */
    private $jclx;
    /**
     * @var string $zxcsnr 执行措施内容
     */
    private $zxcsnr;
    /**
     * @var string $sjje 涉及金额
     */
    private $sjje;
    /**
     * @var string $jcsm 奖惩说明
     */
    private $jcsm;
    /**
     * @var Organization $organization 发布委办局
     */
    private $organization;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    /**
     * @var Data $data 信用数据
     */
    private $data;
    /**
     * @var Measure $measure 奖惩措施
     */
    private $measure;
    /**
     * @var Organization $fkbm 反馈部门
     */
    private $fkbm;

    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->hhmdmc = '';
        $this->ztmc = '';
        $this->ztlb = 0;
        $this->identify = '';
        $this->zjlx = 0;
        $this->jclx = 0;
        $this->zxcsnr = '';
        $this->sjje = '';
        $this->jcsm = '';
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->organization = new Organization();
        $this->data = new Data();
        $this->measure = new Measure();
        $this->fkbm = new Organization();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new RapCaseRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->hhmdmc);
        unset($this->ztmc);
        unset($this->ztlb);
        unset($this->identify);
        unset($this->zjlx);
        unset($this->jclx);
        unset($this->zxcsnr);
        unset($this->sjje);
        unset($this->jcsm);
        unset($this->staff);
        unset($this->organization);
        unset($this->data);
        unset($this->measure);
        unset($this->fkbm);
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

    public function setHhmdmc(string $hhmdmc): void
    {
        $this->hhmdmc = $hhmdmc;
    }

    public function getHhmdmc(): string
    {
        return $this->hhmdmc;
    }

    public function setZtmc(string $ztmc): void
    {
        $this->ztmc = $ztmc;
    }

    public function getZtmc(): string
    {
        return $this->ztmc;
    }

    public function setZtlb(int $ztlb): void
    {
        $this->ztlb = $ztlb;
    }

    public function getZtlb(): int
    {
        return $this->ztlb;
    }

    public function setIdentify(string $identify): void
    {
        $this->identify = $identify;
    }

    public function getIdentify(): string
    {
        return $this->identify;
    }

    public function setZjlx(int $zjlx): void
    {
        $this->zjlx = $zjlx;
    }

    public function getZjlx(): int
    {
        return $this->zjlx;
    }

    public function setJclx(int $jclx): void
    {
        $this->jclx = $jclx;
    }

    public function getJclx(): int
    {
        return $this->jclx;
    }
    
    public function setZxcsnr(string $zxcsnr): void
    {
        $this->zxcsnr = $zxcsnr;
    }

    public function getZxcsnr(): string
    {
        return $this->zxcsnr;
    }
    
    public function setSjje(string $sjje): void
    {
        $this->sjje = $sjje;
    }

    public function getSjje(): string
    {
        return $this->sjje;
    }
    
    public function setJcsm(string $jcsm): void
    {
        $this->jcsm = $jcsm;
    }

    public function getJcsm(): string
    {
        return $this->jcsm;
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
    
    public function setData(Data $data): void
    {
        $this->data = $data;
    }

    public function getData(): Data
    {
        return $this->data;
    }

    public function setMeasure(Measure $measure): void
    {
        $this->measure = $measure;
    }

    public function getMeasure(): Measure
    {
        return $this->measure;
    }

    public function setFkbm(Organization $fkbm): void
    {
        $this->fkbm = $fkbm;
    }

    public function getFkbm(): Organization
    {
        return $this->fkbm;
    }

    protected function getRepository() : RapCaseRepository
    {
        return $this->repository;
    }

    public function update() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
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
}
