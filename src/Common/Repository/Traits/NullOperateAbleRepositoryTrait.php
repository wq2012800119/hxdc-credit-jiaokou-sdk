<?php
namespace Sdk\Common\Repository\Traits;

use Sdk\Common\Model\Interfaces\IOperateAble;

trait NullOperateAbleRepositoryTrait
{
    abstract protected function repositoryNotExist() : bool;
    
    public function insert(IOperateAble $operateAbleObject) : bool
    {
        unset($operateAbleObject);
        return $this->repositoryNotExist();
    }

    public function update(IOperateAble $operateAbleObject) : bool
    {
        unset($operateAbleObject);
        return $this->repositoryNotExist();
    }

    public function enable(IOperateAble $operateAbleObject) : bool
    {
        unset($operateAbleObject);
        return $this->repositoryNotExist();
    }

    public function disable(IOperateAble $operateAbleObject) : bool
    {
        unset($operateAbleObject);
        return $this->repositoryNotExist();
    }
}
