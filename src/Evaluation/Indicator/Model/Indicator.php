<?php
namespace Sdk\Evaluation\Indicator\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Evaluation\Indicator\Repository\IndicatorRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

class Indicator implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    /**
     * 信息类别
     * XZGL 行政管理
     * CSSX 诚实守信
     * YZSX 严重失信
     * PRAISE 信用表扬
     * COMPLAINT 信用投诉
     */
    const INFO_CATEGORY = array(
        'XZGL' => 2,
        'CSSX' => 3,
        'YZSX' => 4,
        'PRAISE' => 6,
        'COMPLAINT' => 7
    );

    const INFO_CATEGORY_CN = array(
        self::INFO_CATEGORY['XZGL'] => '行政管理',
        self::INFO_CATEGORY['CSSX'] => '诚实守信',
        self::INFO_CATEGORY['YZSX'] => '严重失信',
        self::INFO_CATEGORY['PRAISE'] => '信用表扬',
        self::INFO_CATEGORY['COMPLAINT'] => '信用投诉'
    );

    const INFO_CATEGORY_REPORT_KEYS_NAME = array(
        self::INFO_CATEGORY['XZGL'] => 'xzgl',
        self::INFO_CATEGORY['CSSX'] => 'cssx',
        self::INFO_CATEGORY['YZSX'] => 'yzsx',
        self::INFO_CATEGORY['PRAISE'] => 'userEvaluate',
        self::INFO_CATEGORY['COMPLAINT'] => 'userEvaluate'
    );

    const INFO_CATEGORY_REPORT_NAME = array(
        self::INFO_CATEGORY_REPORT_KEYS_NAME[self::INFO_CATEGORY['XZGL']] => '行政管理信息',
        self::INFO_CATEGORY_REPORT_KEYS_NAME[self::INFO_CATEGORY['CSSX']] => '诚实守信信息',
        self::INFO_CATEGORY_REPORT_KEYS_NAME[self::INFO_CATEGORY['YZSX']] => '严重失信信息',
        self::INFO_CATEGORY_REPORT_KEYS_NAME[self::INFO_CATEGORY['PRAISE']] => '用户评价',
        self::INFO_CATEGORY_REPORT_KEYS_NAME[self::INFO_CATEGORY['COMPLAINT']] => '用户评价',
    );

    /**
     * 指标分类
     * FORWARD_DIRECTION 正向
     * NEGATIVE_DIRECTION 负向
     */
    const CATEGORY = array(
        'FORWARD_DIRECTION' => 1,
        'NEGATIVE_DIRECTION' => -1
    );

    const CATEGORY_CN = array(
        self::CATEGORY['FORWARD_DIRECTION'] => '正向',
        self::CATEGORY['NEGATIVE_DIRECTION'] => '负向'
    );
    
    /**
     * 评价指标数据源的主体类别
     * FRJFFRZZ 法人及非法人组织
     * ZRR 自然人
     * GTGSH 个体工商户
     */
    const SOURCE_SUBJECT_CATEGORY = array(
        'FRJFFRZZ' => 1,
        'ZRR' => 2,
        'GTGSH' => 4
    );

    const SOURCE_SUBJECT_CATEGORY_CN = array(
        self::SOURCE_SUBJECT_CATEGORY['FRJFFRZZ'] => '法人及非法人组织',
        self::SOURCE_SUBJECT_CATEGORY['ZRR'] => '自然人',
        self::SOURCE_SUBJECT_CATEGORY['GTGSH'] => '个体工商户'
    );

    private $id;
    /**
     * @var string $name 指标名称
     */
    private $name;
    /**
     * @var int $infoCategory 评价类别
     */
    private $infoCategory;
    /**
     * @var string $description 指标说明
     */
    private $description;
    /**
     * @var int $category 指标分类
     */
    private $category;
    /**
     * @var int $sourceId 评价指标数据源id
     */
    private $sourceId;
    /**
     * @var string $sourceName 评价指标数据源名称
     */
    private $sourceName;
    /**
     * @var array $sourceSubjectCategory 评价指标数据源的主体类别
     */
    private $sourceSubjectCategory;
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
        $this->infoCategory = 0;
        $this->description = '';
        $this->category = 0;
        $this->sourceId = 0;
        $this->sourceName = '';
        $this->sourceSubjectCategory = array();
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new IndicatorRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->infoCategory);
        unset($this->description);
        unset($this->category);
        unset($this->sourceId);
        unset($this->sourceName);
        unset($this->sourceSubjectCategory);
        unset($this->organization);
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

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setInfoCategory(int $infoCategory): void
    {
        $this->infoCategory = $infoCategory;
    }

    public function getInfoCategory(): int
    {
        return $this->infoCategory;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    public function getCategory(): int
    {
        return $this->category;
    }
    
    public function setSourceId(int $sourceId): void
    {
        $this->sourceId = $sourceId;
    }

    public function getSourceId(): int
    {
        return $this->sourceId;
    }

    public function setSourceName(string $sourceName): void
    {
        $this->sourceName = $sourceName;
    }

    public function getSourceName(): string
    {
        return $this->sourceName;
    }
    
    public function setSourceSubjectCategory(array $sourceSubjectCategory): void
    {
        $this->sourceSubjectCategory = $sourceSubjectCategory;
    }

    public function getSourceSubjectCategory(): array
    {
        return $this->sourceSubjectCategory;
    }

    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }
    
    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    protected function getRepository() : IndicatorRepository
    {
        return $this->repository;
    }
}
