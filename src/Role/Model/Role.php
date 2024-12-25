<?php
namespace Sdk\Role\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Role\Repository\RoleRepository;

class Role implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    private $id;
    /**
     * @var string $name 名称
     */
    private $name;
    /**
     * @var array $purview 权限
     */
    private $purview;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->name = '';
        $this->purview = array();
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new RoleRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->purview);
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

    public function setPurview(array $purview): void
    {
        $this->purview = $purview;
    }

    public function getPurview(): array
    {
        return $this->purview;
    }

    protected function getRepository() : RoleRepository
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
