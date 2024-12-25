<?php
namespace Sdk\Common\Adapter\Traits;

use Sdk\Common\Model\Interfaces\IOperateAble;

class OperateAbleMockAdapterTraitMock
{
    use OperateAbleMockAdapterTrait;

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
