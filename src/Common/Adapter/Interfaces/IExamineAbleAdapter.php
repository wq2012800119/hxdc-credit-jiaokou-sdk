<?php
namespace Sdk\Common\Adapter\Interfaces;

use Sdk\Common\Model\Interfaces\IExamineAble;

interface IExamineAbleAdapter
{
    public function approve(IExamineAble $examineAbleObject) : bool;

    public function reject(IExamineAble $examineAbleObject) : bool;
}
