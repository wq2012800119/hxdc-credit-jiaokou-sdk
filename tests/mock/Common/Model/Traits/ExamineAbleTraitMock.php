<?php
namespace Sdk\Common\Model\Traits;

use Sdk\Common\Repository\MockRepository;
use Sdk\Common\Model\Interfaces\IExamineAble;

class ExamineAbleTraitMock implements IExamineAble
{
    use ExamineAbleTrait;

    protected function getRepository()
    {
        return new MockRepository();
    }

    public function approvePublic() : bool
    {
        return $this->approve();
    }

    public function rejectPublic() : bool
    {
        return $this->reject();
    }

    public function isPendingExamineStatusPublic() : bool
    {
        return $this->isPendingExamineStatus();
    }
}
