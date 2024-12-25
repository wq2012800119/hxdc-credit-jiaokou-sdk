<?php
namespace Sdk\Common\Adapter\Interfaces;

use Sdk\Common\Model\Interfaces\IOperateAble;

interface IOperateAbleAdapter
{
    public function insert(IOperateAble $operateAbleObject) : bool;

    public function update(IOperateAble $operateAbleObject) : bool;

    public function enable(IOperateAble $operateAbleObject) : bool;

    public function disable(IOperateAble $operateAbleObject) : bool;
}
