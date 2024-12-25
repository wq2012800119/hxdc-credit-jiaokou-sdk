<?php
namespace Sdk\CreditReport\DownloadRecord\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\CreditReport\DownloadRecord\Repository\DownloadRecordRepository;

use Sdk\User\Member\Model\Member;

class DownloadRecord implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    /**
     * 应用领域
     * ZFCG 政府采购
     * XMZTB 项目招投标
     * XZSP 行政审批
     * SCZR 市场准入
     * ZZSHRD 资质审核认定
     * CZZJBZ 财政资金补助
     * PYPJ 评优评级
     * GSZZRYXCSY 公司资质荣誉宣传使用
     * ZSYZ 招商引资
     * ZFTZGCJS 政府投资工程建设
     * GYZCCQJY 国有资产产权交易
     * LSSSYHZC 落实税收优惠政策
     * JRJGGL 金融监督管理
     * ZDLYHZYHJ 重点领域和重要环节
     * QT 其他
     */
    const DOMAIN = array(
        'ZFCG' => 1,
        'XMZTB' => 2,
        'XZSP' => 3,
        'SCZR' => 4,
        'ZZSHRD' => 5,
        'CZZJBZ' => 6,
        'PYPJ' => 7,
        'GSZZRYXCSY' => 8,
        'ZSYZ' => 9,
        'ZFTZGCJS' => 10,
        'GYZCCQJY' => 11,
        'LSSSYHZC' => 12,
        'JRJGGL' => 13,
        'ZDLYHZYHJ' => 14,
        'QT' => 15
    );

    const DOMAIN_CN = array(
        self::DOMAIN['ZFCG'] => '政府采购',
        self::DOMAIN['XMZTB'] => '项目招投标',
        self::DOMAIN['XZSP'] => '行政审批',
        self::DOMAIN['SCZR'] => '市场准入',
        self::DOMAIN['ZZSHRD'] => '资质审核认定',
        self::DOMAIN['CZZJBZ'] => '财政资金补助',
        self::DOMAIN['PYPJ'] => '评优评级',
        self::DOMAIN['GSZZRYXCSY'] => '公司资质荣誉宣传使用',
        self::DOMAIN['ZSYZ'] => '招商引资',
        self::DOMAIN['ZFTZGCJS'] => '政府投资工程建设',
        self::DOMAIN['GYZCCQJY'] => '国有资产产权交易',
        self::DOMAIN['LSSSYHZC'] => '落实税收优惠政策',
        self::DOMAIN['JRJGGL'] => '金融监督管理',
        self::DOMAIN['ZDLYHZYHJ'] => '重点领域和重要环节',
        self::DOMAIN['QT'] => '其他'
    );

    /**
     * 使用对象
     * GR 个人
     * QY 企业
     * JRHLJRJG 金融或类金融机构
     * DSZF 电商支付
     * ZF 政府
     */
    const TARGET = array(
        'GR' => 1,
        'QY' => 2,
        'JRHLJRJG' => 3,
        'DSZF' => 4,
        'ZF' => 5,
    );

    const TARGET_CN = array(
        self::TARGET['GR'] => '个人',
        self::TARGET['QY'] => '企业',
        self::TARGET['JRHLJRJG'] => '金融或类金融机构',
        self::TARGET['DSZF'] => '电商支付',
        self::TARGET['ZF'] => '政府',
    );

    /**
     * 主体类别
     * FRJFFRZZ 法人及非法人组织
     * ZRR 自然人
     */
    const SUBJECT_CATEGORY = array(
        'FRJFFRZZ' => 1,
        'ZRR' => 2
    );

    const SUBJECT_CATEGORY_CN = array(
        self::SUBJECT_CATEGORY['FRJFFRZZ'] => '法人及非法人组织',
        self::SUBJECT_CATEGORY['ZRR'] => '自然人'
    );

    private $id;
    /**
     * @var int $domain 应用领域
     */
    private $domain;
    /**
     * @var int $target 使用对象
     */
    private $target;
    /**
     * @var string $description 说明
     */
    private $description;
    /**
     * @var int $subjectId 信用报告主体id
     */
    private $subjectId;
    /**
     * @var int $subjectCategory 信用报告主体类别
     */
    private $subjectCategory;
    /**
     * @var string $subjectName 信用报告主体名称
     */
    private $subjectName;
    /**
     * @var Member $member 下载用户
     */
    private $member;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->domain = 0;
        $this->target = 0;
        $this->description = '';
        $this->subjectId = 0;
        $this->subjectCategory = 0;
        $this->subjectName = '';
        $this->member = Core::$container->has('member') ? Core::$container->get('member') : new Member();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new DownloadRecordRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->domain);
        unset($this->target);
        unset($this->description);
        unset($this->subjectId);
        unset($this->subjectCategory);
        unset($this->subjectName);
        unset($this->member);
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

    public function setDomain(int $domain): void
    {
        $this->domain = $domain;
    }

    public function getDomain(): int
    {
        return $this->domain;
    }

    public function setTarget(int $target): void
    {
        $this->target = $target;
    }

    public function getTarget(): int
    {
        return $this->target;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setSubjectId(int $subjectId): void
    {
        $this->subjectId = $subjectId;
    }

    public function getSubjectId(): int
    {
        return $this->subjectId;
    }

    public function setSubjectCategory(int $subjectCategory): void
    {
        $this->subjectCategory = $subjectCategory;
    }

    public function getSubjectCategory(): int
    {
        return $this->subjectCategory;
    }

    public function setSubjectName(string $subjectName): void
    {
        $this->subjectName = $subjectName;
    }

    public function getSubjectName(): string
    {
        return $this->subjectName;
    }

    public function setMember(Member $member): void
    {
        $this->member = $member;
    }

    public function getMember(): Member
    {
        return $this->member;
    }

    protected function getRepository() : DownloadRecordRepository
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
