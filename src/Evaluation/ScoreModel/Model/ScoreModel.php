<?php
namespace Sdk\Evaluation\ScoreModel\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Evaluation\ScoreModel\Repository\ScoreModelRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

class ScoreModel implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    /**
     * 被评对象
     * FRJFFRZZ 法人及非法人组织
     * ZRR 自然人
     * GTGSH 个体工商户
     */
    const OBJECT = array(
        'FRJFFRZZ' => 1,
        'ZRR' => 2,
        'GTGSH' => 4
    );

    const OBJECT_CN = array(
        self::OBJECT['FRJFFRZZ'] => '法人及非法人组织',
        self::OBJECT['ZRR'] => '自然人',
        self::OBJECT['GTGSH'] => '个体工商户',
    );

    private $id;
    /**
     * @var string $name 名称
     */
    private $name;
    /**
     * @var string $description 指标说明
     */
    private $description;
    /**
     * @var array $object 被评对象
     */
    private $object;
    /**
     * @var int $maxScore 模型最高分数
     */
    private $maxScore;
    /**
     * @var int $baseScore 模型基础分数
     */
    private $baseScore;
    /**
     * @var array $ranks 评分等级
     */
    private $ranks;
    /**
     * @var array $indicatorWeights 评分指标权重
     */
    private $indicatorWeights;
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
        $this->description = '';
        $this->object = array();
        $this->maxScore = 0;
        $this->baseScore = 0;
        $this->ranks = array();
        $this->indicatorWeights = array();
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new ScoreModelRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->description);
        unset($this->object);
        unset($this->maxScore);
        unset($this->baseScore);
        unset($this->ranks);
        unset($this->indicatorWeights);
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

    public function setObject(array $object): void
    {
        $this->object = $object;
    }

    public function getObject(): array
    {
        return $this->object;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setMaxScore(int $maxScore): void
    {
        $this->maxScore = $maxScore;
    }

    public function getMaxScore(): int
    {
        return $this->maxScore;
    }
    
    public function setBaseScore(int $baseScore): void
    {
        $this->baseScore = $baseScore;
    }

    public function getBaseScore(): int
    {
        return $this->baseScore;
    }

    public function setRanks(array $ranks): void
    {
        $this->ranks = $ranks;
    }

    public function getRanks(): array
    {
        return $this->ranks;
    }
    
    public function setIndicatorWeights(array $indicatorWeights): void
    {
        $this->indicatorWeights = $indicatorWeights;
    }

    public function getIndicatorWeights(): array
    {
        return $this->indicatorWeights;
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

    protected function getRepository() : ScoreModelRepository
    {
        return $this->repository;
    }
}
