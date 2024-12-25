<?php
namespace Sdk\Common\Repository\Traits;

use Sdk\Common\Model\Interfaces\IOperateAble;

class NullOperateAbleRepositoryTraitMock
{
    use NullOperateAbleRepositoryTrait;

    protected function repositoryNotExist() : bool
    {
        return false;
    }

    public function insertPublic(IOperateAble $operateAbleObject)
    {
        return $this->insert($operateAbleObject);
    }

    public function updatePublic(IOperateAble $operateAbleObject)
    {
        return $this->update($operateAbleObject);
    }

    public function enablePublic(IOperateAble $operateAbleObject)
    {
        return $this->enable($operateAbleObject);
    }

    public function disablePublic(IOperateAble $operateAbleObject)
    {
        return $this->disable($operateAbleObject);
    }
}
