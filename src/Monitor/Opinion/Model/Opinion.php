<?php
namespace Sdk\Monitor\Opinion\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Monitor\Opinion\Repository\OpinionRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class Opinion implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    /**
     * 情感类别
     * SENSITIVE 敏感
     * NEUTRAL 中性
     * NON_SENSITIVE 非敏感
     */
    const CATEGORY = array(
        'SENSITIVE' => -1,
        'NEUTRAL' => 0,
        'NON_SENSITIVE' => 1
    );

    const CATEGORY_CN = array(
        self::CATEGORY['SENSITIVE'] => '敏感',
        self::CATEGORY['NEUTRAL'] => '中性',
        self::CATEGORY['NON_SENSITIVE'] => '非敏感'
    );
    
    /**
     * 情感类别
     * WEI_BO 微博
     * CLIENT 客户端
     * INTERACTIVE_FORUM 互动论坛
     * WEBSITE 网站
     * OFFICIAL_ACCOUNT 公众号
     */
    const SOURCE = array(
        'WEI_BO' => 1,
        'CLIENT' => 2,
        'INTERACTIVE_FORUM' => 3,
        'WEBSITE' => 4,
        'OFFICIAL_ACCOUNT' => 5
    );

    const SOURCE_CN = array(
        self::SOURCE['WEI_BO'] => '微博',
        self::SOURCE['CLIENT'] => '客户端',
        self::SOURCE['INTERACTIVE_FORUM'] => '互动论坛',
        self::SOURCE['WEBSITE'] => '网站',
        self::SOURCE['OFFICIAL_ACCOUNT'] => '公众号'
    );
    
    private $id;
    /**
     * @var string $name 名称
     */
    private $name;
    /**
     * @var string $keyword 主题关键词
     */
    private $keyword;
    /**
     * @var int $category 情感类别
     */
    private $category;
    /**
     * @var int $source 来源
     */
    private $source;
    /**
     * @var int $pubDate 发布时间
     */
    private $pubDate;
    /**
     * @var string $content 内容
     */
    private $content;
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
        $this->keyword = '';
        $this->category = 0;
        $this->source = 0;
        $this->pubDate = 0;
        $this->content = '';
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->organization = new Organization();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new OpinionRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->keyword);
        unset($this->category);
        unset($this->source);
        unset($this->pubDate);
        unset($this->content);
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

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setKeyword(string $keyword): void
    {
        $this->keyword = $keyword;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    public function getCategory(): int
    {
        return $this->category;
    }

    public function setSource(int $source): void
    {
        $this->source = $source;
    }

    public function getSource(): int
    {
        return $this->source;
    }

    public function setPubDate(int $pubDate): void
    {
        $this->pubDate = $pubDate;
    }

    public function getPubDate(): int
    {
        return $this->pubDate;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
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
    
    protected function getRepository() : OpinionRepository
    {
        return $this->repository;
    }
}
