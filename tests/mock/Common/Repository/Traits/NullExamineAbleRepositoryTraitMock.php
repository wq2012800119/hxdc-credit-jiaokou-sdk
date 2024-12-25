<?php
namespace Sdk\Common\Repository\Traits;

use Sdk\Common\Model\Interfaces\IExamineAble;

class NullExamineAbleRepositoryTraitMock
{
    use NullExamineAbleRepositoryTrait;

    protected function repositoryNotExist() : bool
    {
        return false;
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
