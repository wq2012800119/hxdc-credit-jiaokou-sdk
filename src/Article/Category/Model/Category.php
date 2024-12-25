<?php
namespace Sdk\Article\Category\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Article\Category\Repository\CategoryRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

class Category implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    /**
     * 分类等级
     * ONE_LEVEL => 1, 一级
     * SECOND_LEVEL => 2, 二级
     */
    const LEVEL = array(
        'ONE_LEVEL' => 1,
        'SECOND_LEVEL' => 2
    );

    const LEVEL_CN = array(
        self::LEVEL['ONE_LEVEL'] => '一级',
        self::LEVEL['SECOND_LEVEL'] => '二级'
    );

    /**
     * 风格
     * STYLE_ONE => 1, 风格一
     * STYLE_TWO => 2, 风格二
     * STYLE_THREE => 3, 风格三
     */
    const STYLE = array(
        'STYLE_ONE' => 1,
        'STYLE_TWO' => 2,
        'STYLE_THREE' => 3
    );

    const STYLE_CN = array(
        self::STYLE['STYLE_ONE'] => '风格一',
        self::STYLE['STYLE_TWO'] => '风格二',
        self::STYLE['STYLE_THREE'] => '风格三'
    );

    private $id;
    /**
     * @var string $name 名称
     */
    private $name;
    /**
     * @var int $level 等级
     */
    private $level;
    /**
     * @var int $parentCategoryId 一级分类id
     */
    private $parentCategoryId;
    /**
     * @var string $parentCategoryName 一级分类名称
     */
    private $parentCategoryName;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    /**
     * @var int $style 展示风格
     */
    private $style;
    /**
     * @var array $diyContent 自定义内容
     */
    private $diyContent;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->name = '';
        $this->level = 0;
        $this->parentCategoryId = 0;
        $this->parentCategoryName = '';
        $this->style = 0;
        $this->diyContent = array();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new CategoryRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->level);
        unset($this->parentCategoryId);
        unset($this->parentCategoryName);
        unset($this->style);
        unset($this->diyContent);
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

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setStyle(int $style): void
    {
        $this->style = $style;
    }

    public function getStyle(): int
    {
        return $this->style;
    }

    public function setDiyContent(array $diyContent): void
    {
        $this->diyContent = $diyContent;
    }

    public function getDiyContent(): array
    {
        return $this->diyContent;
    }

    public function setParentCategoryId(int $parentCategoryId): void
    {
        $this->parentCategoryId = $parentCategoryId;
    }

    public function getParentCategoryId(): int
    {
        return $this->parentCategoryId;
    }

    public function setParentCategoryName(string $parentCategoryName): void
    {
        $this->parentCategoryName = $parentCategoryName;
    }

    public function getParentCategoryName(): string
    {
        return $this->parentCategoryName;
    }

    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    protected function getRepository() : CategoryRepository
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

    public function diy() : bool
    {
        return $this->getRepository()->diy($this);
    }
}
