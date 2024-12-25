<?php
namespace Sdk\Common\Repository\Traits;

use Sdk\Common\Adapter\MockRestfulAdapter;
use Sdk\Common\Model\Interfaces\IExamineAble;

class ExamineAbleRepositoryTraitMock
{
    use ExamineAbleRepositoryTrait;

    protected function getAdapter()
    {
        return new MockRestfulAdapter();
    }

    public function approvePublic(IExamineAble $examineAbleObject)
    {
        return $this->approve($examineAbleObject);
    }

    public function rejectPublic(IExamineAble $examineAbleObject)
    {
        return $this->reject($examineAbleObject);
    }
}
