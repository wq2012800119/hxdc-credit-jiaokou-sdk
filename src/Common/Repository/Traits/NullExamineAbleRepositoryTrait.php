<?php
namespace Sdk\Common\Repository\Traits;

use Sdk\Common\Model\Interfaces\IExamineAble;

trait NullExamineAbleRepositoryTrait
{
    abstract protected function repositoryNotExist() : bool;
    
    public function approve(IExamineAble $examineAbleObject) : bool
    {
        unset($examineAbleObject);
        return $this->repositoryNotExist();
    }

    public function reject(IExamineAble $examineAbleObject) : bool
    {
        unset($examineAbleObject);
        return $this->repositoryNotExist();
    }
}
