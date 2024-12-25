<?php
namespace Sdk\Common\Adapter\Traits;

use Sdk\Common\Model\Interfaces\IExamineAble;

class ExamineAbleMockAdapterTraitMock
{
    use ExamineAbleMockAdapterTrait;

    public function approvePublic(IExamineAble $examineAbleObject)
    {
        return $this->approve($examineAbleObject);
    }

    public function rejectPublic(IExamineAble $examineAbleObject)
    {
        return $this->reject($examineAbleObject);
    }
}
