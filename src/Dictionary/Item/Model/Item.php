<?php
namespace Sdk\Dictionary\Item\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Dictionary\Category\Model\Category;

use Sdk\Dictionary\Item\Repository\ItemRepository;

class Item implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    /**
     * 所属分类
     * JURISDICTION_AREA => 1, 所属辖区
     */
    const CATEGORY = array(
        'JURISDICTION_AREA' => 1
    );

    private $id;
    /**
     * @var string $name 名称
     */
    private $name;
    /**
     * @var Category $category 所属分类
     */
    private $category;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->name = '';
        $this->category = new Category();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new ItemRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->category);
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

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    protected function getRepository() : ItemRepository
    {
        return $this->repository;
    }
}
