<?php
namespace Sdk\Article\Article\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\TopAbleTrait;
use Sdk\Common\Model\Interfaces\ITopAble;
use Sdk\Common\Model\Traits\ExamineAbleTrait;
use Sdk\Common\Model\Interfaces\IExamineAble;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Article\Category\Model\Category;
use Sdk\Article\Article\Repository\ArticleRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

use Sdk\Sensitive\Result\Model\SensitiveResult;
/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class Article implements IObject, IOperateAble, ITopAble, IExamineAble
{
    use Object, OperateAbleTrait, ExamineAbleTrait, TopAbleTrait;

    /**
     * 是否设为轮播
     * NO 否
     * YES 是
     */
    const IS_SLIDES = array(
        'NO' => 0,
        'YES' => 1
    );

    const IS_SLIDES_CN = array(
        self::IS_SLIDES['NO'] => '否',
        self::IS_SLIDES['YES'] => '是'
    );

    /**
     * 是否设为首页轮播
     * NO 否
     * YES 是
     */
    const IS_HOME_SLIDES = array(
        'NO' => 0,
        'YES' => 1
    );

    const IS_HOME_SLIDES_CN = array(
        self::IS_HOME_SLIDES['NO'] => '否',
        self::IS_HOME_SLIDES['YES'] => '是'
    );

    /**
     * 统计预警状态
     * OVERDUE 超期
     * EARLY_WARNING 预警
     * NORMAL 正常
     */
    const STATISTICS_WARNING_STATUS = array(
        'OVERDUE' => -2,
        'EARLY_WARNING' => -1,
        'NORMAL' => 0
    );

    const STATISTICS_WARNING_STATUS_CN = array(
        self::STATISTICS_WARNING_STATUS['OVERDUE'] => '超期',
        self::STATISTICS_WARNING_STATUS['EARLY_WARNING'] => '预警',
        self::STATISTICS_WARNING_STATUS['NORMAL'] => '正常'
    );

    private $id;
    /**
     * @var string $title 标题
     */
    private $title;
    /**
     * @var string $source 来源
     */
    private $source;
    /**
     * @var Category $parentCategory 一级分类
     */
    private $parentCategory;
    /**
     * @var Category $category 二级分类
     */
    private $category;
    /**
     * @var int $pubDate 发布时间
     */
    private $pubDate;
    /**
     * @var string $description 描述
     */
    private $description;
    /**
     * @var array $cover 封面
     */
    private $cover;
    /**
     * @var array $attachments 附件
     */
    private $attachments;
    /**
     * @var array $content 内容
     */
    private $content;
    /**
     * @var int $isSlides 是否设为轮播
     */
    private $isSlides;
    /**
     * @var int $isHomeSlides 是否设为轮播
     */
    private $isHomeSlides;
    /**
     * @var array $slidesPicture 轮播图
     */
    private $slidesPicture;
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
        $this->title = '';
        $this->source = '';
        $this->parentCategory = new Category();
        $this->category = new Category();
        $this->pubDate = 0;
        $this->description = '';
        $this->cover = array();
        $this->attachments = array();
        $this->content = array();
        $this->isSlides = self::IS_SLIDES['NO'];
        $this->isHomeSlides = self::IS_HOME_SLIDES['NO'];
        $this->slidesPicture = array();
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->topStatus = self::TOP_STATUS['NO_TOP'];
        $this->status = self::STATUS['ENABLED'];
        $this->examineStatus = self::EXAMINE_STATUS['PENDING'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new ArticleRepository();
    }
    

    public function __destruct()
    {
        unset($this->id);
        unset($this->title);
        unset($this->source);
        unset($this->parentCategory);
        unset($this->category);
        unset($this->pubDate);
        unset($this->description);
        unset($this->cover);
        unset($this->attachments);
        unset($this->content);
        unset($this->isSlides);
        unset($this->isHomeSlides);
        unset($this->slidesPicture);
        unset($this->organization);
        unset($this->staff);
        unset($this->topStatus);
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

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function setParentCategory(Category $parentCategory): void
    {
        $this->parentCategory = $parentCategory;
    }

    public function getParentCategory(): Category
    {
        return $this->parentCategory;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setPubDate(int $pubDate): void
    {
        $this->pubDate = $pubDate;
    }

    public function getPubDate(): int
    {
        return $this->pubDate;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setCover(array $cover): void
    {
        $this->cover = $cover;
    }

    public function getCover(): array
    {
        return $this->cover;
    }

    public function setAttachments(array $attachments): void
    {
        $this->attachments = $attachments;
    }

    public function getAttachments(): array
    {
        return $this->attachments;
    }

    public function setContent(array $content): void
    {
        $this->content = $content;
    }

    public function getContent(): array
    {
        return $this->content;
    }

    public function setIsSlides(int $isSlides): void
    {
        $this->isSlides = in_array($isSlides, self::IS_SLIDES) ? $isSlides : self::IS_SLIDES['NO'];
    }

    public function getIsSlides(): int
    {
        return $this->isSlides;
    }

    public function setIsHomeSlides(int $isHomeSlides): void
    {
        $this->isHomeSlides = in_array(
            $isHomeSlides,
            self::IS_HOME_SLIDES
        ) ? $isHomeSlides : self::IS_HOME_SLIDES['NO'];
    }

    public function getIsHomeSlides(): int
    {
        return $this->isHomeSlides;
    }

    public function setSlidesPicture(array $slidesPicture): void
    {
        $this->slidesPicture = $slidesPicture;
    }

    public function getSlidesPicture(): array
    {
        return $this->slidesPicture;
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

    protected function getRepository() : ArticleRepository
    {
        return $this->repository;
    }

    public function process() : SensitiveResult
    {
        return $this->getRepository()->process($this);
    }
}
