<?php
namespace Sdk\Contract\Performance\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Contract\Performance\Repository\PerformanceRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class Performance implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    /**
     * 合同类型
     * XZHT 行政合同
     * SCHHT 市场化合同
     */
    const HTLX = array(
        'XZHT' => 1,
        'SCHHT' => 2
    );

    const HTLX_CN = array(
        self::HTLX['XZHT'] => '行政合同',
        self::HTLX['SCHHT'] => '市场化合同'
    );
 
    /**
     * 采购方式
     * JJCG 间接采购
     * XHCG 现货采购
     * ZJCG 直接采购
     * YCHTCG 远期合同采购
     * ZBCG 招标采购
     * FSCG 分散采购
     * WSCG 网上采购
     * JZCG 集中采购
     */
    const CGFS = array(
        'JJCG' => 1,
        'XHCG' => 2,
        'ZJCG' => 3,
        'YCHTCG' => 4,
        'ZBCG' => 5,
        'FSCG' => 6,
        'WSCG' => 7,
        'JZCG' => 8,
    );

    const CGFS_CN = array(
        self::CGFS['JJCG'] => '间接采购',
        self::CGFS['XHCG'] => '现货采购',
        self::CGFS['ZJCG'] => '直接采购',
        self::CGFS['YCHTCG'] => '远期合同采购',
        self::CGFS['ZBCG'] => '招标采购',
        self::CGFS['FSCG'] => '分散采购',
        self::CGFS['WSCG'] => '网上采购',
        self::CGFS['JZCG'] => '集中采购'
    );
    
    /**
     * 所属行业
     * JGZZ 机构组织
     * NLMY 农林牧渔
     * JZJC 建筑建材
     * YJKC 冶金矿产
     * SYHG 石油化工
     * SLSD 水利水电
     * JTYS 交通运输
     * XXCY 信息产业
     * JXJD 机械机电
     * QGSP 轻工食品
     * FZFZ 服装纺织
     * ZYFW 专业服务
     * AQFH 安全防护
     * HBLH 环保绿化
     * LYXX 旅游休闲
     * BGWJ 办公文教
     * DZDG 电子电工
     * WJLP 玩具礼品
     * JJYP 家居用品
     * WZ 物资
     * BZ 包装
     * TY 体育
     * BG 办公
     */
    const SSHY = array(
        'JGZZ' => 1,
        'NLMY' => 2,
        'JZJC' => 3,
        'YJKC' => 4,
        'SYHG' => 5,
        'SLSD' => 6,
        'JTYS' => 7,
        'XXCY' => 8,
        'JXJD' => 9,
        'QGSP' => 10,
        'FZFZ' => 11,
        'ZYFW' => 12,
        'AQFH' => 13,
        'HBLH' => 14,
        'LYXX' => 15,
        'BGWJ' => 16,
        'DZDG' => 17,
        'WJLP' => 18,
        'JJYP' => 19,
        'WZ' => 20,
        'BZ' => 21,
        'TY' => 22,
        'BG' => 23,
    );

    const SSHY_CN = array(
        self::SSHY['JGZZ'] => '机构组织',
        self::SSHY['NLMY'] => '农林牧渔',
        self::SSHY['JZJC'] => '建筑建材',
        self::SSHY['YJKC'] => '冶金矿产',
        self::SSHY['SYHG'] => '石油化工',
        self::SSHY['SLSD'] => '水利水电',
        self::SSHY['JTYS'] => '交通运输',
        self::SSHY['XXCY'] => '信息产业',
        self::SSHY['JXJD'] => '机械机电',
        self::SSHY['QGSP'] => '轻工食品',
        self::SSHY['FZFZ'] => '服装纺织',
        self::SSHY['ZYFW'] => '专业服务',
        self::SSHY['AQFH'] => '安全防护',
        self::SSHY['HBLH'] => '环保绿化',
        self::SSHY['LYXX'] => '旅游休闲',
        self::SSHY['BGWJ'] => '办公文教',
        self::SSHY['DZDG'] => '电子电工',
        self::SSHY['WJLP'] => '玩具礼品',
        self::SSHY['JJYP'] => '家居用品',
        self::SSHY['WZ'] => '物资',
        self::SSHY['BZ'] => '包装',
        self::SSHY['TY'] => '体育',
        self::SSHY['BG'] => '办公'
    );

    /**
     * 预警状态
     * NOT_IGNORED 未忽略
     * IGNORED 已忽略
     * EXPIRING_SOON 即将过期
     * EXPIRED 已过期
     */
    const WARNING_STATUS = array(
        'NOT_IGNORED' => 0,
        'IGNORED' => -2,
        'EXPIRING_SOON' => 1,
        'EXPIRED' => 2
    );

    const WARNING_STATUS_CN = array(
        self::WARNING_STATUS['NOT_IGNORED'] => '未忽略',
        self::WARNING_STATUS['IGNORED'] => '已忽略',
        self::WARNING_STATUS['EXPIRING_SOON'] => '即将过期',
        self::WARNING_STATUS['EXPIRED'] => '已过期'
    );

    private $id;
    /**
     * @var string $htbh 合同编号
     */
    private $htbh;
    /**
     * @var string $htmc 合同名称
     */
    private $htmc;
    /**
     * @var int $htlx 合同类型
     */
    private $htlx;
    /**
     * @var string $xmbh 项目编号
     */
    private $xmbh;
    /**
     * @var string $cgr 采购人（甲方）
     */
    private $cgr;
    /**
     * @var string $jfzttyshxydm 甲方主体统一社会信用代码
     */
    private $jfzttyshxydm;
    /**
     * @var string $cgrdz 采购人地址
     */
    private $cgrdz;
    /**
     * @var string $gys 供应商（乙方）
     */
    private $gys;
    /**
     * @var string $yftyshxydm 乙方统一社会信用代码
     */
    private $yftyshxydm;
    /**
     * @var string $gysdz 供应商地址
     */
    private $gysdz;
    /**
     * @var string $gyslxfs 供应商联系方式
     */
    private $gyslxfs;
    /**
     * @var string $zybdmc 主要标的名称
     */
    private $zybdmc;
    /**
     * @var string $ggxh 规格型号（或服务要求）
     */
    private $ggxh;
    /**
     * @var string $zybdsl 主要标的数量
     */
    private $zybdsl;
    /**
     * @var string $zybddj 主要标的单价
     */
    private $zybddj;
    /**
     * @var string $htje 合同金额（万元）
     */
    private $htje;
    /**
     * @var int $lyqx 履约期限
     */
    private $lyqx;
    /**
     * @var string $qzdd 签证地点
     */
    private $qzdd;
    /**
     * @var int $cgfs 采购方式
     */
    private $cgfs;
    /**
     * @var int $htqdrq 合同签订日期
     */
    private $htqdrq;
    /**
     * @var int $htggrq 合同公告日期
     */
    private $htggrq;
    /**
     * @var string $qtbcsy 其他补充事宜
     */
    private $qtbcsy;
    /**
     * @var string $lyzt 履约状态
     */
    private $lyzt;
    /**
     * @var string $ssqy 所属区域
     */
    private $ssqy;
    /**
     * @var int $sshy 所属行业
     */
    private $sshy;
    /**
     * @var int $warningStatus 预警状态
     */
    private $warningStatus;
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
        $this->htbh = '';
        $this->htmc = '';
        $this->htlx = 0;
        $this->xmbh = '';
        $this->cgr = '';
        $this->jfzttyshxydm = '';
        $this->cgrdz = '';
        $this->gys = '';
        $this->yftyshxydm = '';
        $this->gysdz = '';
        $this->gyslxfs = '';
        $this->zybdmc = '';
        $this->ggxh = '';
        $this->zybdsl = '';
        $this->zybddj = '';
        $this->htje = '';
        $this->lyqx = 0;
        $this->qzdd = '';
        $this->cgfs = 0;
        $this->htqdrq = 0;
        $this->htggrq = 0;
        $this->qtbcsy = '';
        $this->lyzt = '';
        $this->ssqy = '';
        $this->sshy = 0;
        $this->warningStatus = 0;
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->organization = new Organization();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new PerformanceRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->htbh);
        unset($this->htmc);
        unset($this->htlx);
        unset($this->xmbh);
        unset($this->cgr);
        unset($this->jfzttyshxydm);
        unset($this->cgrdz);
        unset($this->gys);
        unset($this->yftyshxydm);
        unset($this->gysdz);
        unset($this->gyslxfs);
        unset($this->zybdmc);
        unset($this->ggxh);
        unset($this->zybdsl);
        unset($this->zybddj);
        unset($this->htje);
        unset($this->lyqx);
        unset($this->qzdd);
        unset($this->cgfs);
        unset($this->htqdrq);
        unset($this->htggrq);
        unset($this->qtbcsy);
        unset($this->lyzt);
        unset($this->ssqy);
        unset($this->sshy);
        unset($this->warningStatus);
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

    public function setHtbh(string $htbh): void
    {
        $this->htbh = $htbh;
    }

    public function getHtbh(): string
    {
        return $this->htbh;
    }

    public function setHtmc(string $htmc): void
    {
        $this->htmc = $htmc;
    }

    public function getHtmc(): string
    {
        return $this->htmc;
    }

    public function setHtlx(int $htlx): void
    {
        $this->htlx = $htlx;
    }

    public function getHtlx(): int
    {
        return $this->htlx;
    }

    public function setXmbh(string $xmbh): void
    {
        $this->xmbh = $xmbh;
    }

    public function getXmbh(): string
    {
        return $this->xmbh;
    }

    public function setCgr(string $cgr): void
    {
        $this->cgr = $cgr;
    }

    public function getCgr(): string
    {
        return $this->cgr;
    }

    public function setJfzttyshxydm(string $jfzttyshxydm): void
    {
        $this->jfzttyshxydm = $jfzttyshxydm;
    }

    public function getJfzttyshxydm(): string
    {
        return $this->jfzttyshxydm;
    }

    public function setCgrdz(string $cgrdz): void
    {
        $this->cgrdz = $cgrdz;
    }

    public function getCgrdz(): string
    {
        return $this->cgrdz;
    }

    public function setGys(string $gys): void
    {
        $this->gys = $gys;
    }

    public function getGys(): string
    {
        return $this->gys;
    }

    public function setYftyshxydm(string $yftyshxydm): void
    {
        $this->yftyshxydm = $yftyshxydm;
    }

    public function getYftyshxydm(): string
    {
        return $this->yftyshxydm;
    }

    public function setGysdz(string $gysdz): void
    {
        $this->gysdz = $gysdz;
    }

    public function getGysdz(): string
    {
        return $this->gysdz;
    }

    public function setGyslxfs(string $gyslxfs): void
    {
        $this->gyslxfs = $gyslxfs;
    }

    public function getGyslxfs(): string
    {
        return $this->gyslxfs;
    }

    public function setZybdmc(string $zybdmc): void
    {
        $this->zybdmc = $zybdmc;
    }

    public function getZybdmc(): string
    {
        return $this->zybdmc;
    }

    public function setGgxh(string $ggxh): void
    {
        $this->ggxh = $ggxh;
    }

    public function getGgxh(): string
    {
        return $this->ggxh;
    }

    public function setZybdsl(string $zybdsl): void
    {
        $this->zybdsl = $zybdsl;
    }

    public function getZybdsl(): string
    {
        return $this->zybdsl;
    }

    public function setZybddj(string $zybddj): void
    {
        $this->zybddj = $zybddj;
    }

    public function getZybddj(): string
    {
        return $this->zybddj;
    }

    public function setHtje(string $htje): void
    {
        $this->htje = $htje;
    }

    public function getHtje(): string
    {
        return $this->htje;
    }

    public function setLyqx(int $lyqx): void
    {
        $this->lyqx = $lyqx;
    }

    public function getLyqx(): int
    {
        return $this->lyqx;
    }
    
    public function setQzdd(string $qzdd): void
    {
        $this->qzdd = $qzdd;
    }

    public function getQzdd(): string
    {
        return $this->qzdd;
    }
    
    public function setCgfs(int $cgfs): void
    {
        $this->cgfs = $cgfs;
    }

    public function getCgfs(): int
    {
        return $this->cgfs;
    }
    
    public function setHtqdrq(int $htqdrq): void
    {
        $this->htqdrq = $htqdrq;
    }

    public function getHtqdrq(): int
    {
        return $this->htqdrq;
    }
    
    public function setHtggrq(int $htggrq): void
    {
        $this->htggrq = $htggrq;
    }

    public function getHtggrq(): int
    {
        return $this->htggrq;
    }
    
    public function setQtbcsy(string $qtbcsy): void
    {
        $this->qtbcsy = $qtbcsy;
    }

    public function getQtbcsy(): string
    {
        return $this->qtbcsy;
    }
    
    public function setLyzt(string $lyzt): void
    {
        $this->lyzt = $lyzt;
    }

    public function getLyzt(): string
    {
        return $this->lyzt;
    }
    
    public function setSsqy(string $ssqy): void
    {
        $this->ssqy = $ssqy;
    }

    public function getSsqy(): string
    {
        return $this->ssqy;
    }

    public function setSshy(int $sshy): void
    {
        $this->sshy = $sshy;
    }

    public function getSshy(): int
    {
        return $this->sshy;
    }

    public function setWarningStatus(int $warningStatus): void
    {
        $this->warningStatus = $warningStatus;
    }

    public function getWarningStatus(): int
    {
        return $this->warningStatus;
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
    
    protected function getRepository() : PerformanceRepository
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

    public function ignoreWarning() : bool
    {
        return $this->getRepository()->ignoreWarning($this);
    }
}
