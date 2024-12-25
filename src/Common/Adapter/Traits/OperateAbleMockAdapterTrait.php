<?php
namespace Sdk\Common\Adapter\Traits;

use Sdk\Common\Model\Interfaces\IOperateAble;

trait OperateAbleMockAdapterTrait
{
    public function insert(IOperateAble $operateAbleObject) : bool
    {
        unset($operateAbleObject);
        return true;
    }

    public function update(IOperateAble $operateAbleObject) : bool
    {
        unset($operateAbleObject);
        return true;
    }

    public function enable(IOperateAble $operateAbleObject) : bool
    {
        unset($operateAbleObject);
        return true;
    }

    public function disable(IOperateAble $operateAbleObject) : bool
    {
        unset($operateAbleObject);
        return true;
    }
}
