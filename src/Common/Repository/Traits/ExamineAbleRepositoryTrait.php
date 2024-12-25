<?php
namespace Sdk\Common\Repository\Traits;

use Sdk\Common\Model\Interfaces\IExamineAble;

trait ExamineAbleRepositoryTrait
{
    abstract protected function getAdapter();

    public function approve(IExamineAble $examineAbleObject) : bool
    {
        return $this->getAdapter()->approve($examineAbleObject);
    }

    public function reject(IExamineAble $examineAbleObject) : bool
    {
        return $this->getAdapter()->reject($examineAbleObject);
    }
}
