<?php
namespace Sdk\Common\Repository\Traits;

use Sdk\Common\Model\Interfaces\IOperateAble;

trait OperateAbleRepositoryTrait
{
    abstract protected function getAdapter();

    public function insert(IOperateAble $operateAbleObject) : bool
    {
        return $this->getAdapter()->insert($operateAbleObject);
    }

    public function update(IOperateAble $operateAbleObject) : bool
    {
        return $this->getAdapter()->update($operateAbleObject);
    }

    public function enable(IOperateAble $operateAbleObject) : bool
    {
        return $this->getAdapter()->enable($operateAbleObject);
    }

    public function disable(IOperateAble $operateAbleObject) : bool
    {
        return $this->getAdapter()->disable($operateAbleObject);
    }
}
