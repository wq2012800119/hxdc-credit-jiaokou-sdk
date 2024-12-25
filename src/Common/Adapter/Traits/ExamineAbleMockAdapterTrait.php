<?php
namespace Sdk\Common\Adapter\Traits;

use Sdk\Common\Model\Interfaces\IExamineAble;

trait ExamineAbleMockAdapterTrait
{
    public function approve(IExamineAble $examineAbleObject) : bool
    {
        unset($examineAbleObject);
        return true;
    }

    public function reject(IExamineAble $examineAbleObject) : bool
    {
        unset($examineAbleObject);
        return true;
    }
}
