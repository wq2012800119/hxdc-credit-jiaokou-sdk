<?php
namespace Sdk\Common\Adapter\Traits;

use Sdk\Common\Model\Interfaces\IExamineAble;

trait ExamineAbleRestfulAdapterTrait
{
    abstract protected function getResource() : string;

    public function approve(IExamineAble $examineAbleObject) : bool
    {
        $this->patch(
            $this->getResource().'/'.$examineAbleObject->getId().'/approve'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($examineAbleObject);
            return true;
        }

        return false;
    }

    public function reject(IExamineAble $examineAbleObject) : bool
    {
        $this->patch(
            $this->getResource().'/'.$examineAbleObject->getId().'/reject'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($examineAbleObject);
            return true;
        }

        return false;
    }
}
