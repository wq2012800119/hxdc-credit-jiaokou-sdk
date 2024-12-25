<?php
namespace Sdk\Resource\Directory\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\ExamineAbleTrait;
use Sdk\Common\Model\Interfaces\IExamineAble;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Resource\Directory\Repository\DirectoryRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

use Sdk\Template\Model\Template;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class Directory implements IObject, IOperateAble, IExamineAble
{
    use Object, OperateAbleTrait, ExamineAbleTrait;

    /**
     * 信用主体类别
     * FRJFFRZZ 法人及非法人组织
     * ZRR 自然人
     * GTGSH 个体工商户
     */
    const SUBJECT_CATEGORY = array(
        'FRJFFRZZ' => 1,
        'ZRR' => 2,
        'GTGSH' => 4
    );

    const SUBJECT_CATEGORY_CN = array(
        self::SUBJECT_CATEGORY['FRJFFRZZ'] => '法人及非法人组织',
        self::SUBJECT_CATEGORY['ZRR'] => '自然人',
        self::SUBJECT_CATEGORY['GTGSH'] => '个体工商户'
    );
    
    /**
     * 信息类别
     * JBXX 基本信息
     * XZGL 行政管理
     * CSSX 诚实守信
     * YZSX 严重失信
     * QTXX 其他信息
     */
    const INFO_CATEGORY = array(
        'JBXX' => 1,
        'XZGL' => 2,
        'CSSX' => 3,
        'YZSX' => 4,
        'QTXX' => 5
    );

    const INFO_CATEGORY_CN = array(
        self::INFO_CATEGORY['JBXX'] => '基本信息',
        self::INFO_CATEGORY['XZGL'] => '行政管理',
        self::INFO_CATEGORY['CSSX'] => '诚实守信',
        self::INFO_CATEGORY['YZSX'] => '严重失信',
        self::INFO_CATEGORY['QTXX'] => '其他信息'
    );
        
    /**
     * 信息类别-可新增或编辑的类别
     * CSSX 诚实守信
     * YZSX 严重失信
     * QTXX 其他信息
     */
    const INFO_CATEGORY_OPTIONAL = array(
        'CSSX' => 3,
        'YZSX' => 4,
        'QTXX' => 5
    );

    const INFO_CATEGORY_OPTIONAL_CN = array(
        self::INFO_CATEGORY['CSSX'] => '诚实守信',
        self::INFO_CATEGORY['YZSX'] => '严重失信',
        self::INFO_CATEGORY['QTXX'] => '其他信息'
    );

    const DEFAULT_ITEMS_IDENTIFY = array('XYZTLB', 'GKFW', 'YXQX');
    /**
     * 数据类型
     * ZFX 字符型
     * RQX 日期型
     * ZSX 整数型
     * FDX 浮点型
     * MJX 枚举型
     * JHX 集合型
     */
    const DATA_TYPE = array(
        'ZFX' => 1,
        'RQX' => 2,
        'ZSX' => 3,
        'FDX' => 4,
        'MJX' => 5,
        'JHX' => 6
    );

    const DATA_TYPE_CN = array(
        self::DATA_TYPE['ZFX'] => '字符型',
        self::DATA_TYPE['RQX'] => '日期型',
        self::DATA_TYPE['ZSX'] => '整数型',
        self::DATA_TYPE['FDX'] => '浮点型',
        self::DATA_TYPE['MJX'] => '枚举型',
        self::DATA_TYPE['JHX'] => '集合型'
    );

    /**
     * 是否必填
     * NO 否
     * YES 是
     */
    const REQUIRED = array(
        'NO' => 0,
        'YES' => 1
    );

    const REQUIRED_CN = array(
        self::REQUIRED['NO'] => '否',
        self::REQUIRED['YES'] => '是'
    );

    /**
     * 是否脱敏
     * NO 否
     * YES 是
     */
    const DESENSITIZATION = array(
        'NO' => 0,
        'YES' => 1
    );

    const DESENSITIZATION_CN = array(
        self::DESENSITIZATION['NO'] => '否',
        self::DESENSITIZATION['YES'] => '是'
    );

    /**
     * 公开范围
     * SHGK 社会公开
     * ZWGX 政务共享
     * SQCX 授权查询
     */
    const PUBLICATION_RANGE = array(
        'SHGK' => 1,
        'ZWGX' => 2,
        'SQCX' => 3
    );

    const PUBLICATION_RANGE_CN = array(
        self::PUBLICATION_RANGE['SHGK'] => '社会公开',
        self::PUBLICATION_RANGE['ZWGX'] => '政务共享',
        self::PUBLICATION_RANGE['SQCX'] => '授权查询'
    );

    private $id;
    /**
     * @var string $name 名称
     */
    private $name;
    /**
     * @var string $identify 标识
     */
    private $identify;
    /**
     * @var int $readOnly 只读状态
     */
    private $readOnly;
    /**
     * @var array $subjectCategory 信用主体类别
     */
    private $subjectCategory;
    /**
     * @var int $infoCategory 信息类别
     */
    private $infoCategory;
    /**
     * @var array $sourceUnits 来源单位
     */
    private $sourceUnits;
    /**
     * @var string $description 描述
     */
    private $description;
    /**
     * @var array $items 目标信息
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
     * @var string $version 版本号
     */
    private $version;
    /**
     * @var string $versionDescription 版本描述
     */
    private $versionDescription;
    /**
     * @var int $snapshotId 快照id
     */
    private $snapshotId;
    /**
     * @var Template $template 模板下载信息
     */
    private $template;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->name = '';
        $this->identify = '';
        $this->readOnly = 0;
        $this->subjectCategory = array();
        $this->infoCategory = 0;
        $this->sourceUnits = array();
        $this->description = '';
        $this->items = array();
        $this->organization = new Organization();
        $this->template = new Template();
        $this->version = '';
        $this->versionDescription = '';
        $this->snapshotId = 0;
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = self::STATUS['ENABLED'];
        $this->examineStatus = self::EXAMINE_STATUS['PENDING'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new DirectoryRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->identify);
        unset($this->readOnly);
        unset($this->subjectCategory);
        unset($this->infoCategory);
        unset($this->sourceUnits);
        unset($this->description);
        unset($this->items);
        unset($this->organization);
        unset($this->template);
        unset($this->version);
        unset($this->versionDescription);
        unset($this->snapshotId);
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

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setIdentify(string $identify): void
    {
        $this->identify = $identify;
    }

    public function getIdentify(): string
    {
        return $this->identify;
    }

    public function setReadOnly(int $readOnly): void
    {
        $this->readOnly = $readOnly;
    }

    public function getReadOnly(): int
    {
        return $this->readOnly;
    }
    
    public function setSubjectCategory(array $subjectCategory): void
    {
        $this->subjectCategory = $subjectCategory;
    }

    public function getSubjectCategory(): array
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

    public function addSourceUnit(Organization $sourceUnit): void
    {
        $this->sourceUnits[] = $sourceUnit;
    }

    public function clearSourceUnits(): void
    {
        $this->sourceUnits = [];
    }

    public function setSourceUnits(array $sourceUnits): void
    {
        $this->sourceUnits = $sourceUnits;
    }

    public function getSourceUnits(): array
    {
        return $this->sourceUnits;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersionDescription(string $versionDescription): void
    {
        $this->versionDescription = $versionDescription;
    }

    public function getVersionDescription(): string
    {
        return $this->versionDescription;
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

    public function setTemplate(Template $template): void
    {
        $this->template = $template;
    }

    public function getTemplate(): Template
    {
        return $this->template;
    }
    
    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    public function setSnapshotId(int $snapshotId): void
    {
        $this->snapshotId = $snapshotId;
    }

    public function getSnapshotId(): int
    {
        return $this->snapshotId;
    }
    
    protected function getRepository() : DirectoryRepository
    {
        return $this->repository;
    }

    public function rollback() : bool
    {
        return $this->getRepository()->rollback($this);
    }

    public function export() : bool
    {
        return $this->getRepository()->export($this);
    }
}
