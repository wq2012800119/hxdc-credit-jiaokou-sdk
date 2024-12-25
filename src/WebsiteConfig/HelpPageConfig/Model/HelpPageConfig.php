<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\WebsiteConfig\HelpPageConfig\Repository\HelpPageConfigRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

class HelpPageConfig implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

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
     * @var string $title 标题
     */
    private $title;
    /**
     * @var int $style 展示风格
     */
    private $style;
    /**
     * @var array $diyContent 自定义内容
     */
    private $diyContent;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->title = '';
        $this->style = 0;
        $this->diyContent = array();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new HelpPageConfigRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->title);
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

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
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

    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    protected function getRepository() : HelpPageConfigRepository
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
}
