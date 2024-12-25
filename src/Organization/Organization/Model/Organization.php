<?php
namespace Sdk\Organization\Organization\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Dictionary\Item\Model\Item;

use Sdk\Organization\Organization\Repository\OrganizationRepository;

class Organization implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    private $id;
    /**
     * @var string $name 名称
     */
    private $name;
    /**
     * @var string $shortName 简称
     */
    private $shortName;
    /**
     * @var string $unifiedIdentifier 统一社会信用代码
     */
    private $unifiedIdentifier;
    /**
     * @var Item $jurisdictionArea 所属辖区
     */
    private $jurisdictionArea;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->name = '';
        $this->shortName = '';
        $this->unifiedIdentifier = '';
        $this->jurisdictionArea = new Item();
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new OrganizationRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->shortName);
        unset($this->unifiedIdentifier);
        unset($this->jurisdictionArea);
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

    public function setShortName(string $shortName): void
    {
        $this->shortName = $shortName;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }

    public function setUnifiedIdentifier(string $unifiedIdentifier): void
    {
        $this->unifiedIdentifier = $unifiedIdentifier;
    }

    public function getUnifiedIdentifier(): string
    {
        return $this->unifiedIdentifier;
    }

    public function setJurisdictionArea(Item $jurisdictionArea): void
    {
        $this->jurisdictionArea = $jurisdictionArea;
    }

    public function getJurisdictionArea(): Item
    {
        return $this->jurisdictionArea;
    }

    protected function getRepository() : OrganizationRepository
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
